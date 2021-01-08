@extends('layouts.app')

@section('title', 'Data Pinjaman')

@section('content')

@if (session('status'))
@push('scripts')
<script>
    swal({
        title: "Good job!",
        text: "{{ session('status') }}",
        icon: "success",
        button: false,
        timer: 3000
    });

</script>
@endpush
@endif

<div class="row">
    <div class="col-12 mb-4">

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
            <div class="d-block mb-4 mb-md-0">
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                    <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                        <li class="breadcrumb-item"><a href="#"><span class="fas fa-home"></span></a></li>
                        <li class="breadcrumb-item"><a href="#">Pinjaman</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data Pinjaman</li>
                    </ol>
                </nav>
                <h2 class="h4">Table Pinjaman</h2>
            </div>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group">
                    <a href="{{ route('pinjaman.pdf') }}" class="btn btn-sm btn-outline-danger">Export PDF</a>
                    <a href="{{ route('pinjaman.excel') }}" class="btn btn-sm btn-outline-success">Export Excel</a>
                </div>
            </div>
        </div>
        <div class="card border-light shadow-sm components-section">

            <div class="card-body">
                <div class="row">
                    <table class="table table-hover" id="pinjamanTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Nama Anggota</th>
                                <th>Nominal</th>
                                <th>Jangka Waktu</th>
                                <th>Bagi Hasil</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    <footer class="footer section py-2">

                </div>

            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')

<script>
    // AJAX DataTable
    var datatable = $('#pinjamanTable').DataTable({
        processing: true,
        serverSide: true,
        ordering: true,
        ajax: {
            url: '{!! url()->current() !!}',
        },
        columns: [{
                "data": 'id',
                "sortable": false,
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                data: 'created_at',
                name: 'created_at'
            },
            {
                data: 'anggota',
                name: 'anggota.nama_anggota'
            },
            {
                data: 'nominal',
                name: 'nominal'
            },
            {
                data: 'jangka_waktu',
                name: 'jangka_waktu'
            },
            {
                data: 'bagi_hasil',
                name: 'bagi_hasil'
            },
            {
                data: 'status',
                name: 'status'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
                width: '15%'
            },
        ],

    });

</script>
@endpush
