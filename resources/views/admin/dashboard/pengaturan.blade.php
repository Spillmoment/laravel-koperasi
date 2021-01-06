@extends('layouts.app')

@section('title','Pengaturan Admin')
@section('content')

<div class="py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item"><a href="#"><span class="fas fa-home"></span></a></li>
            <li class="breadcrumb-item"><a href="#">Pengaturan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Pengaturan </li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-12 mb-4">
        <div class="card border-light shadow-sm components-section">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 ">
                        <div class="card card-body bg-white border-light shadow-sm mb-4">
                            <h2 class="h5 mb-4">Pengaturan Akun {{ auth()->user()->name }}</h2>

                            <form method="post" enctype="multipart/form-data"
                                action="{{route('admin.update-pengaturan', Auth::id() )}}">
                                @csrf
                                @method('PUT')

                                <div class="col form-group my-2">
                                    <label for="curr_password">Current Password</label>
                                    <input type="password"
                                        class="form-control {{ $errors->first('current_password') ? 'is-invalid' : '' }}"
                                        name="current_password" id="curr_password" value=""
                                        placeholder="Current Password">
                                    <div class="invalid-feedback">
                                        {{$errors->first('current_password')}}
                                    </div>
                                </div>

                                <div class="col form-group my-2">
                                    <label for="password">Password</label>
                                    <input type="password"
                                        class="form-control {{ $errors->first('password') ? 'is-invalid' : '' }}"
                                        name="password" id="password" value="" placeholder="Password">
                                    <div class="invalid-feedback">
                                        {{$errors->first('password')}}
                                    </div>
                                </div>

                                <div class="col form-group ">
                                    <label for="password">Konfirmasi Password</label>
                                    <input type="password"
                                        class="form-control {{ $errors->first('konfirmasi_password') ? 'is-invalid' : '' }}"
                                        name="konfirmasi_password" id="password" value=""
                                        placeholder="Konfirmasi Password">
                                    <div class="invalid-feedback">
                                        {{$errors->first('konfirmasi_password')}}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                                </div>

                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
