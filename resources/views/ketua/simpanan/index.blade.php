@extends('layouts.app')

@section('title', 'Ketua - Data Simpanan')

@section('content')

<div class="py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item"><a href="#"><span class="fas fa-home"></span></a></li>
            <li class="breadcrumb-item"><a href="#">Simpanan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data Simpanan</li>
        </ol>
    </nav>

</div>

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
        <div class="card border-light shadow-sm components-section">
            <div class="row">
                <div class="col-md-4">
                    <a href="{{ route('simpanan.excel') }}" class="btn btn-success ml-2"> <i
                            class="fas fa-file-excel"></i>
                        Excel</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <table class="table table-hover" id="simpananTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>ID Anggota</th>
                                <th>Nama Anggota</th>
                                <th>Jenis Simpanan</th>
                                <th>Nominal</th>
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
    var datatable = $('#simpananTable').DataTable({
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
                data: 'anggota_id',
                name: 'anggota_id'
            },
            {
                data: 'anggota',
                name: 'anggota.nama_anggota'
            },
            {
                data: 'jenis_simpanan_id',
                name: 'jenis_simpanan_id'
            },
            {
                data: 'nominal',
                name: 'nominal'
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
