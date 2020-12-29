<?php

namespace App\Http\Controllers\Ketua;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Simpanan;
use App\Anggota;
use App\Pinjaman;
use App\Count;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SimpananExports;

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
                                    <a class="dropdown-item" href="' . route('simpanan.show', $item->id) . '">
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

        return view('ketua.simpanan.index');
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        $simpanan = Simpanan::findOrFail($id);
        $anggota = Anggota::findOrFail($simpanan->anggota->id);
        $pinjaman = Pinjaman::with('anggota')->where('anggota_id', $anggota->id)->first();
        $total = Count::with('anggota')->where('anggota_id', $anggota->id)->first();

        $data = [
            'simpanan' => $simpanan,
            'anggota' => $anggota,
            'pinjaman'  => $pinjaman,
            'count' => $total
        ];

        return view('ketua.simpanan.show', $data);
    }

    public function edit($id)
    {
        //
    }

    public function update($id)
    {
        try {
            Pinjaman::findOrFail($id)->update(['status' => 'lunas']);
            return redirect()->route('simpanan.show', [$id])->with(['status' => 'Status Berhasil Diupdate']);
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        Simpanan::findOrFail($id)->delete();
        return redirect()->route('simpanan.index')->with(['status' => 'Simpanan Berhasil Dihapus']);
    }

    public function cetak_excel()
    {
        $tgl = now();
        return Excel::download(new SimpananExports, 'simpanan_' . $tgl . '.xlsx');
    }
}
