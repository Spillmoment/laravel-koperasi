@extends('layouts.app')

@section('title', 'Data Anggota')

@section('content')

<div class="py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item"><a href="#"><span class="fas fa-home"></span></a></li>
            <li class="breadcrumb-item"><a href="#">Anggota</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data Anggota</li>
        </ol>
    </nav>

</div>

<div class="row">
    <div class="col-12 mb-4">
        <div class="card border-light shadow-sm components-section">
            <div class="card card-body border-light shadow-sm table-wrapper table-responsive pt-0">
                <br>
                <table class="table table-hover table-striped" id="crudTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>No. kTP</th>
                            <th>Nama</th>
                            <th>Kota</th>
                            <th>Telepon</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

            </div>
            <footer class="footer section py-2">
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // AJAX DataTable
    var datatable = $('#crudTable').DataTable({
        processing: true,
        serverSide: true,
        ordering: true,
        ajax: {
            url: '{!! url()->current() !!}',
        },
        columns: [{
                data: 'id',
                name: 'id'
            },
            {
                data: 'no_ktp',
                name: 'no_ktp'
            },
            {
                data: 'nama_anggota',
                name: 'nama_anggota'
            },
            {
                data: 'kota',
                name: 'kota'
            },
            {
                data: 'telepon',
                name: 'telepon'
            },
            {
                data: 'pengurus',
                name: 'pengurus'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
                width: '15%'
            },
        ]
    });

</script>
@endpush
