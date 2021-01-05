<?php

namespace App\Http\Controllers\Ketua;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\JenisSimpanan;
use Yajra\DataTables\Facades\DataTables;

class JenisSimpananController extends Controller
{

    public function index()
    {
        if (request()->ajax()) {
            $query = JenisSimpanan::query();

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
                        <a class="dropdown-item" href="' . route('jenis-simpanan.edit', $item->id) . '"><span class="fas fa-eye mr-2"></span>Details</a>
                        <form action="' . route('jenis-simpanan.destroy', $item->id) . '" method="POST">
                                            ' . method_field('delete') . csrf_field() . '
                                            <button type="submit" class="dropdown-item text-danger">
                                            <span class="fas fa-trash-alt mr-2"></span>Hapus</a>
                                            </button>
                                        </form>
                    </div>
                </div>';
                })
                ->editColumn('minimal_simpan', function ($item) {
                    return "Rp." . number_format($item->minimal_simpan, 0, ',', '.');
                })
                ->rawColumns(['action', 'status'])
                ->make();
        }

        return view('ketua.jenis_simpanan.index');
    }



    public function create()
    {
        return view('ketua.jenis_simpanan.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama_simpanan' => 'required',
            'minimal_simpan' => 'required|numeric'
        ]);

        JenisSimpanan::create($request->all());
        return redirect()->route('jenis_simpanan.index')
            ->with(['status' => 'Data Jenis Simpanan Berhasil Ditambahkan']);
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $simpanan = JenisSimpanan::findOrFail($id);
        return view('ketua.jenis_simpanan.show', compact('simpanan'));
    }


    public function update(Request $request, JenisSimpanan $jenisSimpanan)
    {
        $request->validate([
            'nama_simpanan' => 'required',
            'minimal_simpan' => 'required|numeric'
        ]);

        $data = $request->all();
        $jenisSimpanan->update($data);
        return redirect()->route('jenis-simpanan.index')
            ->with(['status' => 'Data Jenis Simpanan Berhasil Diupdate']);
    }


    public function destroy(JenisSimpanan $jenisSimpanan)
    {
        $jenisSimpanan->delete();
        return redirect()->back();
    }
}
