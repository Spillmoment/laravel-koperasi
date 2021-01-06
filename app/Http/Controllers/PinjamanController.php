<?php

namespace App\Http\Controllers;

use App\Pinjaman;
use App\Anggota;
use App\Pengaturan;
use App\BayarPinjaman;
use \Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PinjamanController extends Controller
{
  
    public function index()
    {
        if (request()->ajax()) {
            $query = Pinjaman::query()->with(['anggota']);

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return
                        '    <div class="btn-group">
                    <button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="icon icon-sm">
                            <span class="fas fa-ellipsis-h icon-dark"></span>
                        </span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="action' .  $item->id . '">
                        <a class="dropdown-item" href="' . route('pinjaman-ketua.show', $item->id) . '"><span class="fas fa-eye mr-2"></span>Details</a>
                        <form action="' . route('pinjaman-ketua.destroy', $item->id) . '" method="POST">
                                            ' . method_field('delete') . csrf_field() . '
                                            <button type="submit" class="dropdown-item text-danger">
                                            <span class="fas fa-trash-alt mr-2"></span>Hapus</a>
                                            </button>
                                        </form>
                    </div>
                </div>';
                })
                ->editColumn('created_at', function ($item) {
                    return $item->created_at->format('d F Y');
                })
                ->addColumn('anggota', function ($item) {
                    return $item->anggota->nama_anggota;
                })
                ->editColumn('nominal', function ($item) {
                    return "Rp." . number_format($item->nominal, 0, ',', '.');
                })
                ->editColumn('jangka_waktu', function ($item) {
                    return $item->jangka_waktu . " Hari";
                })
                ->editColumn('bagi_hasil', function ($item) {
                    return $item->bagi_hasil . " %";
                })
                ->editColumn('status', function ($item) {
                    if ($item->status == 'lunas') {
                        return "<span class='text-success font-weight-bold'>" . $item->status .  "</span>";
                    } elseif ($item->status == 'pending') {
                        return "<span class='text-primary font-weight-bold'>" . $item->status .  "</span>";
                    } else {
                        return "<span class='text-danger font-weight-bold'>" . $item->status .  "</span>";
                    }
                })
                ->rawColumns(['action', 'status'])
                ->make();
        }

        return view('member.pinjaman.pinjaman_index');
    }

   
    public function create()
    {
        $data_anggota = Anggota::all();
        $data_pengaturan = Pengaturan::all()->take(1)->first();
        return view('member.pinjaman.pinjaman_create', compact('data_anggota', 'data_pengaturan'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'anggota_id' => 'required|exists:anggota,id',
            'jangka_waktu' => 'required|integer|between:1,12',
            'nominal' => 'required|numeric',
            'keterangan' => 'max:200',
        ]);

        $cek_jasa = Pengaturan::first();
        $nominal = $request->nominal;
        $bagi_hasil = $cek_jasa->jasa_pinjam / 100;
        $waktu = $request->jangka_waktu;

        $pokok = $nominal / $waktu;
        $hasil_bagi = $bagi_hasil * $nominal;
        $perbulan = $pokok + $hasil_bagi;
        $total = $perbulan * $waktu;

        $cek_pinjaman_user = Pinjaman::where('anggota_id', $request->anggota_id)
            ->where(function ($q) {
                $q->where('status', 'pending')
                    ->orWhere('status', 'belum_lunas');
            })
            ->exists();

        if ($cek_pinjaman_user) {
            return redirect()->route('pinjaman.create')->with(['error' => 'Anggota masih memiliki tanggungan pinjaman.']);
        } else {
            $pinjaman = Pinjaman::create([
                'anggota_id' =>  $request->anggota_id,
                'nominal' => $nominal,
                'bagi_hasil' => $cek_jasa->jasa_pinjam,
                'jangka_waktu' => $request->jangka_waktu,
                'bayar_pokok' => $pokok,
                'hasil_bagi' => $hasil_bagi,
                'bayar_perbulan' => $perbulan,
                'total' => $total,
                'keterangan' => $request->keterangan,
                'status' => 'pending',
            ]);

            for ($bulan = 1; $bulan <= $waktu; $bulan++) {
                $date = Carbon::now('Asia/Jakarta');
                $date->modify('+' . $bulan . ' month');
                BayarPinjaman::create([
                    'pinjaman_id' => $pinjaman->id,
                    'jatuh_tempo' => $date->format('Y-m-d'),
                    'tanggal_bayar' => null,
                    'nominal' => $perbulan,
                    'denda' => null,
                    'keterangan' => null,
                ]);
            }
            // dd($bayar_pinjaman);

            return redirect()->route('pinjaman.create')->with(['success' => 'Pinjaman berhasil ditambahkan.']);
        }
    }

    public function show(Pinjaman $pinjaman)
    {
        //
    }

   
    public function edit(Pinjaman $pinjaman)
    {
        //
    }

   
    public function update(Request $request, Pinjaman $pinjaman)
    {
        //
    }

   
    public function destroy(Pinjaman $pinjaman)
    {
        //
    }

    public function bayar_pinjaman($id)
    {
        $data_pinjaman = Pinjaman::find($id);
        $detail_pinjaman = BayarPinjaman::where('pinjaman_id', $data_pinjaman->id)->get();
        return view('member.pinjaman.pinjaman_bayar', compact('data_pinjaman', 'detail_pinjaman'));
    }

    public function bayar_pinjaman_detail($id, $bayarpinjamid)
    {
        $data_pinjaman = Pinjaman::find($id);
        $detail_pinjaman = BayarPinjaman::where('id', $bayarpinjamid)->first();

        $tempo = Carbon::parse($detail_pinjaman->jatuh_tempo);
        $today = Carbon::now('Asia/Jakarta');

        if ($tempo < $today) {
            $selisih = $tempo->diffInDays($today);
            $telat_hari = $selisih;
            $denda = 1000 * $selisih;
        } else {
            $telat_hari = 0;
            $denda = 0;
        }

        return view('member.pinjaman.pinjaman_bayar_detail', compact('data_pinjaman', 'detail_pinjaman', 'telat_hari', 'denda'));
    }

    public function bayar_pinjaman_post(Request $request, $id, $bayarpinjamid)
    {
        BayarPinjaman::where('id', $bayarpinjamid)->update([
            'tanggal_bayar' => Carbon::now('Asia/Jakarta'),
            'denda' => $request->denda,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('pinjaman.index')->with(['success' => 'Pembayaran berhasil.']);
    }
}
