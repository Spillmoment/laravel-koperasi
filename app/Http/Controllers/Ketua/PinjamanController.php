<?php

namespace App\Http\Controllers\Ketua;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pinjaman;
use App\Anggota;
use App\Count;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PinjamanExports;
use PDF;

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

        return view('ketua.pinjaman.index');
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
        $pinjaman = Pinjaman::findOrFail($id);
        $anggota = Anggota::findOrFail($pinjaman->anggota->id);
        $total = Count::with('anggota', 'jenis_simpanan')->where('anggota_id', $anggota->id)->first();

        $data = [
            'pinjaman'  => $pinjaman,
            'anggota' => $anggota,
            'count' => $total
        ];

        return view('ketua.pinjaman.show', $data);
    }

    public function edit($id)
    {
        //
    }

    public function update($id)
    {
        try {
            Pinjaman::findOrFail($id)->update(['status' => 'belum_lunas']);
            return redirect()->route('pinjaman-ketua.show', [$id])->with(['status' => 'Status Berhasil Diupdate']);
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        Pinjaman::findOrFail($id)->delete();
        return redirect()->route('pinjaman-ketua.index')->with(['status' => 'Pinjaman Berhasil Dihapus']);
    }

    public function cetak_excel()
    {
        $tgl = now();
        return Excel::download(new PinjamanExports, 'Laporan-Pinjaman-' . $tgl . '.xlsx');
    }

    public function cetak_pdf()
    {
        $tgl = now();
        $pinjaman = Pinjaman::latest()->get();
        $pdf = PDF::loadview('ketua.report.pinjaman_pdf', ['pinjaman' => $pinjaman]);
        return $pdf->download('laporan-pinjaman-' . $tgl . '.pdf');
    }
}
