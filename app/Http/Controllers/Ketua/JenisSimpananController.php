<?php

namespace App\Http\Controllers\Ketua;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\JenisSimpanan;

class JenisSimpananController extends Controller
{

    public function index()
    {
        $jenis_simpanan = JenisSimpanan::orderBy('created_at', 'desc')->paginate(10);
        return view('ketua.pinjaman.index', compact('jenis_simpanan'));
    }


    public function create()
    {
        return view('ketua.pinjaman.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama_simpanan' => 'required',
            'minimal_simpan' => 'required|numeric'
        ]);

        JenisSimpanan::create($request->all());
        return redirect()->route('jenis-pinjaman.index')
            ->with(['status' => 'Data Jenis Simpanan Berhasil Ditambahkan']);
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $simpanan = JenisSimpanan::findOrFail($id);
        return view('ketua.pinjaman.show', compact('simpanan'));
    }


    public function update(Request $request, JenisSimpanan $jenisSimpanan)
    {
        $request->validate([
            'nama_simpanan' => 'required',
            'minimal_simpan' => 'required|numeric'
        ]);

        $data = $request->all();
        $jenisSimpanan->update($data);
        return redirect()->route('jenis-simpanan.index');
    }


    public function destroy(JenisSimpanan $jenisSimpanan)
    {
        $jenisSimpanan->delete();
        return redirect()->back();
    }
}
