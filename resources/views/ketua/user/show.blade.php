@extends('layouts.app')

@section('title', 'Edit User')

@section('content')




<div class="py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item"><a href="#"><span class="fas fa-home"></span></a></li>
            <li class="breadcrumb-item"><a href="#">User</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit User</li>
        </ol>
    </nav>

</div>

<div class="row">
    <div class="col-12 mb-4">
        <div class="card border-light shadow-sm components-section">
            <div class="card-body">
                <form action="{{ route('user.update',$user->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row mb-4">
                        <div class="col-lg-5 col-sm-6">
                            <div class="mb-3">
                                <label for="name">Nama Lengkap</label>
                                <input type="text" class="form-control {{ $errors->first('name') ? 'is-invalid' : '' }}"
                                    id="name" name="name" value="{{ $user->name  }}">
                                <div class="invalid-feedback">
                                    {{$errors->first('name')}}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input type="text"
                                    class="form-control {{ $errors->first('email') ? 'is-invalid' : '' }}" id="email"
                                    name="email" value="{{ $user->email  }}">
                                <div class="invalid-feedback">
                                    {{$errors->first('email')}}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="image">Image</label>
                                <input type="file" class="form-control-file" name="image" id="image" placeholder=""
                                    aria-describedby="fileHelpId">
                                <small id="fileHelpId" class="form-text text-muted">kosongkan jika tidak mengubah
                                    foto</small>
                                <div class="invalid-feedback">
                                    {{$errors->first('image')}}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="password">Password</label>
                                <input type="password"
                                    class="form-control {{ $errors->first('password') ? 'is-invalid' : '' }}"
                                    name="password" id="password" value="" placeholder="Password">
                                <div class="invalid-feedback">
                                    {{$errors->first('password')}}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="password">Konfirmasi Password</label>
                                <input type="password"
                                    class="form-control {{ $errors->first('konfirmasi_password') ? 'is-invalid' : '' }}"
                                    name="konfirmasi_password" id="password" value="" placeholder="Konfirmasi Password">
                                <div class="invalid-feedback">
                                    {{$errors->first('konfirmasi_password')}}
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="mb-3">
                                    <label>Roles</label>
                                    <select name="roles" required class="form-control">
                                        <option value="{{ $user->roles }}">Biarkan default jika tidak diubah</option>
                                        <option value="admin">Admin</option>
                                        <option value="ketua">Ketua</option>
                                    </select>
                                </div>
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
