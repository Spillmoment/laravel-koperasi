@extends('layouts.app')

@section('title', 'Data Anggota')

@section('content')

<div class="row">
    <div class="col-12 mb-4">
        <div class="card border-light shadow-sm components-section">
            <div class="card-body">     
                <div class="row">

                  <div class="col-12 col-xl-8">
                    <div class="card card-body bg-white border-light shadow-sm mb-4">
                        <h2 class="h5 mb-4">Informasi Umum</h2>
                        <form action="{{ route('anggota.update', [$anggota->id]) }}" method="POST">
                            @method('put')
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div>
                                        <label for="no_ktp">No. KTP</label>
                                        <input class="form-control {{ $errors->first('no_ktp') ? 'is-invalid' : '' }}" name="no_ktp" type="text" value="{{ $anggota->no_ktp }}" required>
                                        <div class="invalid-feedback">
                                            {{$errors->first('no_ktp')}}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div>
                                        <label for="nama_anggota">Nama</label>
                                        <input class="form-control {{ $errors->first('nama_anggota') ? 'is-invalid' : '' }}" name="nama_anggota" type="text" value="{{ $anggota->nama_anggota }}" required>
                                        <div class="invalid-feedback">
                                            {{$errors->first('nama_anggota')}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-md-6 mb-3">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select class="form-select mb-0 {{ $errors->first('jenis_kelamin') ? 'is-invalid' : '' }}" name="jenis_kelamin" aria-label="jenis_kelamin select example">
                                        <option value="laki-laki" {{ $anggota->jenis_kelamin == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="perempuan" {{ $anggota->jenis_kelamin == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        {{$errors->first('jenis_kelamin')}}
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="kota">Kota</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><span class="fas fa-building"></span></span>
                                        <input type="text" class="form-control {{ $errors->first('kota') ? 'is-invalid' : '' }}" name="kota" value="{{ $anggota->kota }}" required>
                                        {{-- <div class="invalid-feedback">
                                            {{$errors->first('kota')}}
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md mb-3">
                                    <label for="textarea">Alamat</label>
                                    <textarea class="form-control {{ $errors->first('alamat') ? 'is-invalid' : '' }}" name="alamat" rows="4">{{ $anggota->alamat }}</textarea>
                                    <div class="invalid-feedback">
                                        {{$errors->first('alamat')}}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="telepon">Telepon</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><span class="fas fa-phone"></span></span>
                                        <input type="text" class="form-control {{ $errors->first('telepon') ? 'is-invalid' : '' }}" name="telepon" value="{{ $anggota->telepon }}">
                                        {{-- <div class="invalid-feedback">
                                            {{$errors->first('telepon')}}
                                        </div> --}}
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="pengurus">Kepengurusan</label>
                                    <select class="form-select mb-0" name="pengurus" aria-label="pengurus select example">
                                        <option value="pengurus" {{ $anggota->pengurus == 'pengurus' ? 'selected' : '' }}>Pengurus</option>
                                        <option value="bukan_pengurus" {{ $anggota->pengurus == 'bukan_pengurus' ? 'selected' : '' }}>Bukan Pengurus</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                        <h2 class="h5 my-4">Adress</h2>
                    </div>
                </div>
                <div class="col-12 col-xl-4">
                    <div class="row">
                        <div class="col-12 mb-4">
                            <div class="card border-light text-center p-0">
                                <div class="profile-cover rounded-top" style="background-image: url('https://cdn.consumerscu.org/wp-content/uploads/2019/08/checking_account_1566231082.jpeg')"></div>
                                <div class="card-body pb-5">
                                    <img src="https://ui-avatars.com/api/?name={{ $anggota['nama_anggota'] }}&uppercase=false&background=random&color=random&size=128&font-size=0.33" class="user-avatar large-avatar rounded-circle mx-auto mt-n7 mb-4" alt="{{ $anggota['nama_anggota'] }}">
                                    <h4 class="h3">{{ $anggota['nama_anggota'] }}</h4>
                                    <h5 class="font-weight-normal">Koperasi Simpan Pinjam</h5>
                                    <p class="text-gray mb-4">{{ $anggota['kota'] }}, Jawa Timur</p>
                                    <a class="btn btn-sm btn-primary mr-2" href="#"><span class="fas fa-user-plus mr-1"></span> Connect</a>
                                    <a class="btn btn-sm btn-secondary" href="#">Send Message</a>
                                </div>
                             </div>
                        </div>
                        <div class="col-12">
                            <div class="card card-body bg-white border-light shadow-sm mb-4">
                                <h2 class="h5 mb-4">Select profile photo</h2>
                                <div class="d-xl-flex align-items-center">
                                    <div>
                                        <!-- Avatar -->
                                        <div class="user-avatar xl-avatar mb-3">
                                            <img class="rounded" src="../assets/img/team/profile-picture-3.jpg" alt="change avatar">
                                        </div>
                                    </div>
                                    <div class="file-field">
                                        <div class="d-flex justify-content-xl-center ml-xl-3">
                                           <div class="d-flex">
                                              <span class="icon icon-md"><span class="fas fa-paperclip mr-3"></span></span> <input type="file">
                                              <div class="d-md-block text-left">
                                                 <div class="font-weight-normal text-dark mb-1">Choose Image</div>
                                                 <div class="text-gray small">JPG, GIF or PNG. Max size of 800K</div>
                                              </div>
                                           </div>
                                        </div>
                                     </div>                                        
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                </div>
                
            </div>
        </div>
    </div>
</div>
    
@endsection