@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')




<div class="py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item"><a href="#"><span class="fas fa-home"></span></a></li>
            <li class="breadcrumb-item"><a href="#">User</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah User</li>
        </ol>
    </nav>

</div>

<div class="row">
    <div class="col-12 mb-4">
        <div class="card border-light shadow-sm components-section">
            <div class="card-body">
                <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-4">
                        <div class="col-lg-5 col-sm-6">
                            <div class="mb-3">
                                <label for="name">Nama Lengkap</label>
                                <input type="text" class="form-control {{ $errors->first('name') ? 'is-invalid' : '' }}"
                                    id="name" name="name" value="{{ old('name')  }}">
                                <div class="invalid-feedback">
                                    {{$errors->first('name')}}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input type="email"
                                    class="form-control {{ $errors->first('email') ? 'is-invalid' : '' }}" id="email"
                                    name="email" value="{{ old('email')  }}">
                                <div class="invalid-feedback">
                                    {{$errors->first('email')}}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="image">Image</label>
                                <input type="file" name="image" id="image">
                                <div class="invalid-feedback">
                                    {{$errors->first('image')}}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="password">Password</label>
                                <input type="password"
                                    class="form-control {{ $errors->first('password') ? 'is-invalid' : '' }}"
                                    name="password" id="password" value="{{old('password')}}" placeholder="Password">
                                <div class="invalid-feedback">
                                    {{$errors->first('password')}}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="password">Konfirmasi Password</label>
                                <input type="password"
                                    class="form-control {{ $errors->first('konfirmasi_password') ? 'is-invalid' : '' }}"
                                    name="konfirmasi_password" id="password" value="{{old('konfirmasi_password')}}"
                                    placeholder="Password">
                                <div class="invalid-feedback">
                                    {{$errors->first('konfirmasi_password')}}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label>Roles</label>
                                <select name="roles" required class="form-control">
                                    <option value="admin">Admin</option>
                                    <option value="ketua">Ketua</option>
                                </select>
                            </div>

                        </div>


                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection
