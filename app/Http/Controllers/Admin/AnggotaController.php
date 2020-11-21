<?php

namespace App\Http\Controllers\Admin;

<<<<<<< HEAD:app/Http/Controllers/Admin/AnggotaController.php
use App\Http\Controllers\Controller;
=======
use App\Anggota;
use App\JenisSimpanan;
use App\Simpanan;
>>>>>>> origin/fitur-simpanan:app/Http/Controllers/AnggotaController.php
use Illuminate\Http\Request;
use App\Anggota;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search =  $request->input('q');
        if ($search) {
            $anggota = Anggota::where('nama_anggota', 'like', '%' . $search . '%')
                ->latest()->paginate(6);
        } else {
            $anggota = Anggota::latest()->paginate(6);
        }
        return view('admin.member.anggota_index', compact('anggota'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
<<<<<<< HEAD:app/Http/Controllers/Admin/AnggotaController.php
        return view('admin.member.anggota_create');
=======
        $min_simpanan = JenisSimpanan::find(1);
        return view('member.anggota_create', compact('min_simpanan'));
>>>>>>> origin/fitur-simpanan:app/Http/Controllers/AnggotaController.php
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
            'no_ktp' => 'required|unique:anggota|digits:3',
            'nama_anggota' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'alamat' => 'required|max:200',
            'kota' => 'required|max:20',
            'telepon' => 'required|max:12',
            'pengurus' => 'required|in:pengurus,bukan_pengurus',
        ]);

<<<<<<< HEAD:app/Http/Controllers/Admin/AnggotaController.php
        $data = $request->all();
        Anggota::create($data);
        return redirect()->back()->with(['success' => 'Data Anggota Berhasil Ditambahkan']);
=======
        // $data = $request->all();

        // Anggota::create($data);
        $min_simpanan = JenisSimpanan::find(1);

        $anggota = new Anggota;
        $anggota->no_ktp = $request->no_ktp;
        $anggota->nama_anggota = $request->nama_anggota;
        $anggota->jenis_kelamin = $request->jenis_kelamin;
        $anggota->alamat = $request->alamat;
        $anggota->kota = $request->kota;
        $anggota->telepon = $request->telepon;
        $anggota->pengurus = $request->pengurus;
        $anggota->save();

        $simpanan = new Simpanan;
        // $simpanan->anggota_id = $anggota->id;
        $simpanan->jenis_simpanan_id = $min_simpanan->id;
        $simpanan->nominal = $min_simpanan->minimal_simpan;
        $simpanan->keterangan = 'Simpanan wajib saat pendaftaran';

        $anggota->simpanan()->save($simpanan);

        return redirect()->route('anggota.create')->with(['status' => 'Data Anggota Berhasil Ditambahkan']);
>>>>>>> origin/fitur-simpanan:app/Http/Controllers/AnggotaController.php
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    public function show(Anggota $anggota)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    public function edit($anggotum)
    {
        $anggota = Anggota::Find($anggotum);
        return view('admin.member.anggota_show', compact('anggota'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $anggotum)
    {
        $request->validate([
            'no_ktp' => 'required|digits:16|unique:anggota,no_ktp,' . $anggotum,
            'nama_anggota' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
            'telepon' => 'required',
            'pengurus' => 'required'
        ]);

        $anggota = Anggota::findOrFail($anggotum);
        $data = $request->all();

        $anggota->update($data);
        return redirect()->route('anggota.index')->with(['status' => 'Data Berhasil Diubah']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    public function destroy($anggotum)
    {
        $anggota = Anggota::findOrFail($anggotum);
        $anggota->forceDelete();
        return redirect()->route('anggota.index')
            ->with(['status' => 'Data unit Berhasil Dihapus']);
    }
}
