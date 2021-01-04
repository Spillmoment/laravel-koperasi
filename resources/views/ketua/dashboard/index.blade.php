@extends('layouts.app')

@section('title','Ketua - Halaman Dashboard ')
@section('content')

<div class="py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item"><a href="#"><span class="fas fa-home"></span></a></li>
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Statistik Dashboard</li>
        </ol>
    </nav>

</div>

<div class="container">
    <div class="row justify-content-center">

        <div class="col-12 col-sm-6 col-xl-4 mb-4">
            <div class="card border-light shadow-sm">
                <div class="card-body">
                    <div class="row d-block d-xl-flex align-items-center">
                        <div
                            class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                            <div class="icon icon-shape icon-md icon-shape-blue rounded mr-4 mr-sm-0"><span
                                    class="fas fa-users"></span></div>
                        </div>
                        <div class="col-12 col-xl-7 px-xl-0">
                            <div class="d-none d-sm-block">
                                <h2 class="h5">Data Anggota</h2>
                                <h3 class="mb-1">{{ $anggota }}</h3>
                            </div>
                            {{-- <small>Feb 1 - Apr 1, <span class="icon icon-small"><span
                                        class="fas fa-globe-europe"></span></span> WorldWide</small>
                            <div class="small mt-2">
                                <span class="fas fa-angle-up text-success"></span>
                                <span class="text-success font-weight-bold">18.2%</span> Since last month
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-4 mb-4">
            <div class="card border-light shadow-sm">
                <div class="card-body">
                    <div class="row d-block d-xl-flex align-items-center">
                        <div
                            class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                            <div class="icon icon-shape icon-md icon-shape-blue rounded mr-4 mr-sm-0"><span
                                    class="fas fa-database"></span></div>
                        </div>
                        <div class="col-12 col-xl-7 px-xl-0">
                            <div class="d-none d-sm-block">
                                <h2 class="h5">Data Pinjaman</h2>
                                <h3 class="mb-1">{{ $pinjaman }}</h3>
                            </div>
                            {{-- <small>Feb 1 - Apr 1, <span class="icon icon-small"><span
                                        class="fas fa-globe-europe"></span></span> WorldWide</small>
                            <div class="small mt-2">
                                <span class="fas fa-angle-up text-success"></span>
                                <span class="text-success font-weight-bold">18.2%</span> Since last month
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-4 mb-4">
            <div class="card border-light shadow-sm">
                <div class="card-body">
                    <div class="row d-block d-xl-flex align-items-center">
                        <div
                            class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                            <div class="icon icon-shape icon-md icon-shape-blue rounded mr-4 mr-sm-0"><span
                                    class="fas fa-book"></span></div>
                        </div>
                        <div class="col-12 col-xl-7 px-xl-0">
                            <div class="d-none d-sm-block">
                                <h2 class="h5">Data Simpanan</h2>
                                <h3 class="mb-1">{{ $simpanan }}</h3>
                            </div>
                            {{-- <small>Feb 1 - Apr 1, <span class="icon icon-small"><span
                                        class="fas fa-globe-europe"></span></span> WorldWide</small>
                            <div class="small mt-2">
                                <span class="fas fa-angle-up text-success"></span>
                                <span class="text-success font-weight-bold">18.2%</span> Since last month
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
