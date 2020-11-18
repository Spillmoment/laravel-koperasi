@extends('layouts.app')

@section('title','Halaman Dashboard Admin')
@section('content')
    
<div class="py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item"><a href="#"><span class="fas fa-home"></span></a></li>
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Halaman Dashboard</li>
        </ol>
    </nav>
   
</div>

<div class="container">
    <div class="row justify-content-center">
     
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h1>Selamat Datang Admin {{ auth()->user()->name }}</h1>
                    
               
            </div>
        </div>
    </div>
</div>

@endsection