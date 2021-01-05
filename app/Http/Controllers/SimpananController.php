<?php

namespace App\Http\Controllers;

use App\Simpanan;
use App\JenisSimpanan;
use App\Anggota;
use Illuminate\Http\Request;
use DB;

class SimpananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_simpanan = Simpanan::with(['anggota','jenis_simpanan'])->get();
        // dd($data_simpanan);
        return view('member.simpanan.simpanan_index', compact('data_simpanan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data_anggota = Anggota::all();
        $data_jenis_simpanan = JenisSimpanan::all();
        return view('member.simpanan.simpanan_create', compact('data_anggota', 'data_jenis_simpanan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

        return redirect()->route('simpanan.create')->with(['status' => 'Data Simpanan Berhasil Ditambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Simpanan  $simpanan
     * @return \Illuminate\Http\Response
     */
    public function show(Simpanan $simpanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Simpanan  $simpanan
     * @return \Illuminate\Http\Response
     */
    public function edit(Simpanan $simpanan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Simpanan  $simpanan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Simpanan $simpanan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Simpanan  $simpanan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Simpanan $simpanan)
    {
        //
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
		return view('member.simpanan.simpanan_anggota', compact('anggota','data_simpanan', 'simpanan_1', 'count_simpanan_1', 'simpanan_2', 'count_simpanan_2', 'simpanan_3', 'count_simpanan_3'));
 
	}
}
