@extends('layouts.app')

@section('title', 'Tambah Anggota')

@section('content')

<div class="row">
    <div class="col-12 mb-4">
        <div class="card border-light shadow-sm components-section">
            <div class="card-body">     
                <div class="row mb-4">
                    <div class="col-lg-4 col-sm-6">

                        <form action="{{ route('anggota.store') }}" method="post">
                            @csrf

                            <div class="mb-3">
                                <label for="ktp">No. KTP</label>
                                <input type="text" class="form-control" id="no_ktp" name="no_ktp">
                            </div>
                            <div class="mb-3">
                                <label for="nama_anggota">Nama Anggota</label>
                                <input type="text" class="form-control" id="nama_anggota" name="nama_anggota">
                            </div>
                            <div class="mb-3">
                                <fieldset>
                                    <label for="jenkel">Jenis Kelamin</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="radio_laki" value="laki-laki" checked>
                                        <label class="form-check-label" for="radio_laki">
                                        Laki-laki
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="radio_perempuan" value="perempuan">
                                        <label class="form-check-label" for="radio_perempuan">
                                        Perempuan
                                        </label>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="my-4">
                                <label for="textarea">Alamat</label>
                                <textarea class="form-control" placeholder="Tulis alamat lengkap..." id="alamat" name="alamat" rows="4"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="kota">Kota</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fas fa-building"></span></span>
                                    <input type="text" class="form-control" id="kota" name="kota">
                                </div>
                                
                            </div>
                            <div class="mb-3">
                                <label for="telepon">Telepon</label>
                                <div class="input-group">
                                    <span class="input-group-text"><span class="fas fa-phone"></span></span>
                                    <input type="text" class="form-control" id="telepon" name="telepon">
                                </div>
                            </div>
                            <div class="mb-3">
                                <fieldset>
                                    <label for="kepengurusan">Kepengurusan</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="radio_bukan_pengurus" name="kepengurusan" value="0" checked>
                                        <label class="form-check-label" for="radio_bukan_pengurus">
                                        Bukan Pengurus
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="radio_pengurus" name="kepengurusan" value="1">
                                        <label class="form-check-label" for="radio_pengurus">
                                        Pengurus
                                        </label>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="mb-3">
                                <label for="simpanan_wajib">Simpanan Wajib</label>
                                <input type="text" class="form-control" id="simpanan_wajib" name="simpanan_wajib" disabled value="1xxx000">
                                <small class="form-text text-muted">Sebagai syarat tanda keanggotan</small>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-secondary">Simpan</button>
                            </div>
                        </form>
                        
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
    
@endsection