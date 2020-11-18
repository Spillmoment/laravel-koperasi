<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        return view('admin.member.anggota_create');
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
            'no_ktp' => 'required|unique:anggota|digits:16',
            'nama_anggota' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'alamat' => 'required|max:200',
            'kota' => 'required|max:20',
            'telepon' => 'required|max:12',
            'pengurus' => 'required|in:pengurus,bukan_pengurus'
        ]);

        $data = $request->all();
        Anggota::create($data);
        return redirect()->back()->with(['success' => 'Data Anggota Berhasil Ditambahkan']);
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
