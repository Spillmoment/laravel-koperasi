<?php

namespace App\Http\Controllers;

use App\Simpanan;
use App\JenisSimpanan;
use App\Anggota;
use Illuminate\Http\Request;
use DB;

use Yajra\DataTables\Facades\DataTables;

class SimpananController extends Controller
{

    public function index()
    {
        if (request()->ajax()) {
            $query = Simpanan::query()->with(['anggota', 'jenis_simpanan']);

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle mr-1 mb-1" 
                                    type="button" id="action' .  $item->id . '"
                                        data-toggle="dropdown" 
                                        aria-haspopup="true"
                                        aria-expanded="false">
                                        Aksi
                                </button>
                                <div class="dropdown-menu" aria-labelledby="action' .  $item->id . '">
                                    <a class="dropdown-item" href="' . route('simpanan.edit', $item->id) . '">
                                        Sunting
                                    </a>
                                    <form action="' . route('simpanan.destroy', $item->id) . '" method="POST">
                                        ' . method_field('delete') . csrf_field() . '
                                        <button type="submit" class="dropdown-item text-danger">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                    </div>';
                })
                ->editColumn('created_at', function ($item) {
                    return $item->created_at->format('d F Y');
                })
                ->editColumn('anggota_id', function ($item) {
                    return $item->anggota->id;
                })
                ->addColumn('anggota', function ($item) {
                    return $item->anggota->nama_anggota;
                })
                ->editColumn('jenis_simpanan_id', function ($item) {
                    return $item->jenis_simpanan->nama_simpanan;
                })
                ->editColumn('nominal', function ($item) {
                    return "Rp." . number_format($item->nominal, 0, ',', '.');
                })
                ->rawColumns(['action'])
                ->make();
        }

        return view('member.simpanan.simpanan_index');
    }


    public function create()
    {
        $data_anggota = Anggota::all();
        $data_jenis_simpanan = JenisSimpanan::all();
        return view('member.simpanan.simpanan_create', compact('data_anggota', 'data_jenis_simpanan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'anggota_id' => 'required|exists:anggota,id',
            'jenis_simpanan_id' => 'required|exists:jenis_simpanan,id',
            'nominal' => 'required|numeric',
            'keterangan' => 'max:200',
        ]);

        $data = $request->all();

        Simpanan::create($data);

        return redirect('admin/simpanan')->with(['success' => 'Data Simpanan Berhasil Ditambahkan']);
    }


    public function show(Simpanan $simpanan)
    {
        //
    }


    public function edit(Simpanan $simpanan)
    {
        $data_relasi = Simpanan::with(['anggota', 'jenis_simpanan'])->where('id', $simpanan->id)->first();
        $data_jenis_simpanan = JenisSimpanan::all();
        return view('member.simpanan.simpanan_edit', compact('simpanan', 'data_relasi', 'data_jenis_simpanan'));
    }


    public function update(Request $request, Simpanan $simpanan)
    {
        $request->validate([
            'jenis_simpanan_id' => 'required|exists:jenis_simpanan,id',
            'nominal' => 'required|numeric',
            'keterangan' => 'max:200',
        ]);

        Simpanan::where('id', $simpanan->id)->update([
            'jenis_simpanan_id' => $request->jenis_simpanan_id,
            'nominal' => $request->nominal,
            'keterangan' => $request->keterangan,
        ]);

        return redirect('admin/simpanan')->with(['success' => 'Data Berhasil Diupdate.']);
    }


    public function destroy(Simpanan $simpanan)
    {
        $simpanan = Simpanan::findOrFail($simpanan->id);
        $simpanan->forceDelete();
        return redirect('admin/simpanan')->with(['success' => 'Data simpanan ID ' . $simpanan->id . ' Berhasil Dihapus']);
    }

    public function anggota()
    {
        return view('member.simpanan.simpanan_anggota');
    }

    public function cari_anggota(Request $request)
    {
        $cari = $request->cari;

        $anggota = Anggota::where('no_ktp', $cari)->first();

        $data_simpanan = Simpanan::with(['jenis_simpanan'])->select('jenis_simpanan_id', DB::raw('SUM(nominal) as total_simpanan'))->where('anggota_id', $anggota->id)->groupBy('jenis_simpanan_id')->get();
        $simpanan_1 = Simpanan::where('anggota_id', $anggota->id)->where('jenis_simpanan_id', 1)->get();
        $count_simpanan_1 = Simpanan::select(DB::raw('SUM(nominal) as total_simpanan'))->where('anggota_id', $anggota->id)->where('jenis_simpanan_id', 1)->first();
        $simpanan_2 = Simpanan::where('anggota_id', $anggota->id)->where('jenis_simpanan_id', 2)->get();
        $count_simpanan_2 = Simpanan::select(DB::raw('SUM(nominal) as total_simpanan'))->where('anggota_id', $anggota->id)->where('jenis_simpanan_id', 2)->first();
        $simpanan_3 = Simpanan::where('anggota_id', $anggota->id)->where('jenis_simpanan_id', 3)->get();
        $count_simpanan_3 = Simpanan::select(DB::raw('SUM(nominal) as total_simpanan'))->where('anggota_id', $anggota->id)->where('jenis_simpanan_id', 3)->first();
        // dd($count_simpanan_3);
        return view('member.simpanan.simpanan_anggota', compact('anggota', 'data_simpanan', 'simpanan_1', 'count_simpanan_1', 'simpanan_2', 'count_simpanan_2', 'simpanan_3', 'count_simpanan_3'));
    }

    public function penarikan_simpanan()
    {
        // dd('tes');
        $data_anggota = Anggota::all();
        $data_jenis_simpanan = JenisSimpanan::all();
        return view('member.simpanan.simpanan_penarikan', compact('data_anggota', 'data_jenis_simpanan'));
    }

    public function penarikan_post(Request $request)
    {
        $request->validate([
            'anggota_id' => 'required|exists:anggota,id',
            'nominal' => 'required|numeric',
            'keterangan' => 'max:200',
        ]);

        $cek_jumlah = Simpanan::select(DB::raw('SUM(nominal) as total_simpanan'))->where('anggota_id', $request->anggota_id)->where('jenis_simpanan_id', 3)->first();
        $saldo = $cek_jumlah->total_simpanan;
        $ambil = $request->nominal;
        if ($saldo < $ambil) {
            return redirect()->route('simpanan.penarikan')->with(['error' => 'Saldo simpanan sukarela Anda tidak cukup.']);
        } else {
            $simpanan = Simpanan::create([
                'anggota_id' => $request->anggota_id,
                'jenis_simpanan_id' => 3,
                'nominal' => '-' . $request->nominal,
                'keterangan' => $request->keterangan,
            ]);

            return redirect()->route('simpanan.penarikan')->with(['success' => 'Penarikan simpanan berhasil.']);
        }
    }
}
