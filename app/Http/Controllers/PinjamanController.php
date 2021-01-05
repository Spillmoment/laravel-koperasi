<?php

namespace App\Http\Controllers;

use App\Pinjaman;
use App\Anggota;
use App\Pengaturan;
use App\BayarPinjaman;
Use \Carbon\Carbon;
use Illuminate\Http\Request;

class PinjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_pinjaman = Pinjaman::with(['anggota'])->get();
        return view('member.pinjaman.pinjaman_index', compact('data_pinjaman'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data_anggota = Anggota::all();
        $data_pengaturan = Pengaturan::first();
        return view('member.pinjaman.pinjaman_create', compact('data_anggota', 'data_pengaturan'));
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
                                        ->where(function($q) {
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

            for ($bulan=1; $bulan <= $waktu; $bulan++) { 
                $date = Carbon::now('Asia/Jakarta');
                $date->modify('+'.$bulan.' month'); 
                $bayar_pinjaman = BayarPinjaman::create([
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Pinjaman  $pinjaman
     * @return \Illuminate\Http\Response
     */
    public function show(Pinjaman $pinjaman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pinjaman  $pinjaman
     * @return \Illuminate\Http\Response
     */
    public function edit(Pinjaman $pinjaman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pinjaman  $pinjaman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pinjaman $pinjaman)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pinjaman  $pinjaman
     * @return \Illuminate\Http\Response
     */
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
