@extends('layouts.app')

@section('title', 'Data Anggota')

@section('content')

<div class="py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item"><a href="#"><span class="fas fa-home"></span></a></li>
            <li class="breadcrumb-item"><a href="#">Profile</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Profile </li>
        </ol>
    </nav>
</div>

@if (session('status'))
<div class="alert alert-success text-light">{{session('status')}}</div>
@endif

<div class="row">
    <div class="col-12 mb-4">
        <div class="card border-light shadow-sm components-section">
            <div class="card-body">
                <div class="row">

                    <div class="col-12 col-xl-8">
                        <div class="card card-body bg-white border-light shadow-sm mb-4">
                            <h2 class="h5 mb-4">Profile {{ auth()->user()->name }}</h2>
                            <form action="{{ route('admin.update-profile', Auth::id()) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div>
                                            <label for="name">Nama</label>
                                            <input class="form-control {{ $errors->first('name') ? 'is-invalid' : '' }}"
                                                name="name" type="text" value="{{ auth()->user()->name }}" required>
                                            <div class="invalid-feedback">
                                                {{$errors->first('name')}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div>
                                            <label for="email">Email</label>
                                            <input
                                                class="form-control {{ $errors->first('email') ? 'is-invalid' : '' }}"
                                                name="email" type="text" value="{{ auth()->user()->email }}" required>
                                            <div class="invalid-feedback">
                                                {{$errors->first('email')}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>

                        </div>
                    </div>
                    <div class="col-12 col-xl-4">
                        <div class="row">
                            <div class="col-12 mb-4">
                                <div class="card border-light text-center p-0">
                                    <div class="profile-cover rounded-top"
                                        style="background-image: url('https://cdn.consumerscu.org/wp-content/uploads/2019/08/checking_account_1566231082.jpeg')">
                                    </div>
                                    <div class="card-body pb-5">
                                        <img src="https://ui-avatars.com/api/?name={{ auth()->user()->image }}&uppercase=false&background=random&color=random&size=128&font-size=0.33"
                                            class="user-avatar large-avatar rounded-circle mx-auto mt-n7 mb-4"
                                            alt="{{ auth()->user()->image  }}">
                                        <h4 class="h3">{{ auth()->user()->image  }}</h4>
                                        <h5 class="font-weight-normal">Koperasi Simpan Pinjam</h5>

                                        <a class="btn btn-sm btn-primary mr-2" href="#"><span
                                                class="fas fa-user-plus mr-1"></span> Connect</a>
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
                                                <img class="rounded" src="../assets/img/team/profile-picture-3.jpg"
                                                    alt="change avatar">
                                            </div>
                                        </div>
                                        <div class="file-field">
                                            <div class="d-flex justify-content-xl-center ml-xl-3">
                                                <div class="d-flex">
                                                    <span class="icon icon-md"><span
                                                            class="fas fa-paperclip mr-3"></span></span> <input
                                                        type="file">
                                                    <div class="d-md-block text-left">
                                                        <div class="font-weight-normal text-dark mb-1">Choose Image
                                                        </div>
                                                        <div class="text-gray small">JPG, GIF or PNG. Max size of 800K
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
</div>

@endsection
