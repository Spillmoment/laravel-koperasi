<?php

namespace App\Http\Controllers\Ketua;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Simpanan;
use App\Pinjaman;
use App\Anggota;
use App\Count;

class SimpananController extends Controller
{

    public function index()
    {
        $simpanan = Simpanan::with(['anggota', 'jenis_simpanan'])
            ->orderBy('created_at', 'asc')
            ->paginate(12);

        return view('ketua.simpanan.index', [
            'simpanan' => $simpanan,
        ]);
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
        $pinjaman = Pinjaman::findOrFail($id);

        $pinjaman->update([
            'status' => 'lunas'
        ]);

        if ($pinjaman) {
            return redirect()->route('simpanan.show', [$id])->with(['status' => 'Status Berhasil Diupdate']);
        }
    }

    public function destroy($id)
    {
        //
    }
}
