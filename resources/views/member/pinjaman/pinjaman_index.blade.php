@extends('layouts.app')

@section('title', 'Ketua - Data Pinjaman')


@section('content')

@if ($message = Session::get('success'))
@push('scripts')
<script>
    swal({
        title: "Berhasil!",
        text: "{{ session('success') }}",
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

        <div class="card border-light shadow-sm components-section">
            <div class="card-body">     
                <div class="row">

                      <div class="table-settings mb-4">
                        <div class="row align-items-center justify-content-between">
                            <div class="col col-md-6 col-lg-3 col-xl-4">
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon2"><span class="fas fa-search"></span></span>
                                    <input type="text" class="form-control" id="exampleInputIconLeft" placeholder="Search" aria-label="Search" aria-describedby="basic-addon2">
                                </div>
                            </div>
                            <div class="col-4 col-md-2 col-xl-1 pl-md-0 text-right">
                                <div class="btn-group">
                                    <button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="icon icon-sm icon-gray">
                                            <span class="fas fa-cog"></span>
                                        </span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-xs dropdown-menu-right">
                                        <span class="dropdown-item font-weight-bold text-dark">Show</span>
                                        <a class="dropdown-item d-flex font-weight-bold" href="#">10 <span class="icon icon-small ml-auto"><span class="fas fa-check"></span></span></a>
                                        <a class="dropdown-item font-weight-bold" href="#">20</a>
                                        <a class="dropdown-item font-weight-bold" href="#">30</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                      
                      <div class="card card-body border-light shadow-sm table-wrapper table-responsive pt-0">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Nama Anggota</th>	
                                    <th>Nominal</th>
                                    <th>Bagi hasil</th>
                                    <th>Waktu</th>
                                    <th>Pokok</th>
                                    <th>Bagi hasil (Rp)</th>
                                    <th>Per Bulan</th>
                                    <th>Total</th>
                                    <th>Keterangan</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach ($data_pinjaman as $data)
                              <tr>
                                <td>
                                <span class="font-weight-normal">{{ $data->created_at->format('d-m-Y') }}</span>
                                </td>
                                <td>
                                    <span class="font-weight-normal">{{ $data->anggota->nama_anggota }}</span>
                                </td>
                                <td><span class="font-weight-normal">Rp. {{ number_format($data->nominal,2) }}</span></td> 
                                <td><span class="font-weight-bold">{{ $data->bagi_hasil }}%</span></td>
                                <td><span class="font-weight-bold">{{ $data->jangka_waktu }} bulan</span></td>
                                <td><span class="font-weight-bold">Rp. {{ number_format($data->bayar_pokok,2) }}</span></td>
                                <td><span class="font-weight-bold">Rp. {{ number_format($data->hasil_bagi,2) }}</span></td>
                                <td><span class="font-weight-bold">Rp. {{ number_format($data->bayar_perbulan,2) }}</span></td>
                                <td><span class="font-weight-bold">Rp. {{ number_format($data->total,2) }}</span></td>
                                <td><span class="font-weight-bold">{{ $data->keterangan == '' ? '-' : $data->keterangan }}</span></td>
                                <td><span class="font-weight-bold">{{ $data->status }}</span></td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="icon icon-sm">
                                                <span class="fas fa-ellipsis-h icon-dark"></span>
                                            </span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu">
                                            @if ($data->status != 'pending')
                                            <a class="dropdown-item" href="{{ route('pinjaman.bayar', ['id'=>$data->id]) }}"><span class="fas fa-eye mr-2"></span>Angsuran</a>
                                            @else
                                            <a class="dropdown-item" href="{{ route('pinjaman.edit', $data->id) }}"><span class="fas fa-edit mr-2"></span>Edit</a>
                                            
                                            <form action="{{ route('pinjaman.destroy', $data->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="dropdown-item text-danger">
                                                    <span class="fas fa-trash-alt mr-2"></span> Hapus
                                                </button>
                                            </form>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                              </tr>                             
                                  
                              @endforeach 
                            </tbody>
                        </table>
                        {{-- <div class="card-footer px-3 border-0 d-flex align-items-center justify-content-between">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination mb-0">
                                    <li class="page-item">
                                        <a class="page-link" href="#">Previous</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">1</a>
                                    </li>
                                    <li class="page-item active">
                                        <a class="page-link" href="#">2</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">3</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">4</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">5</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">Next</a>
                                    </li>
                                </ul>
                            </nav>
                            <div class="font-weight-bold small">Showing <b>5</b> out of <b>25</b> entries</div>
                        </div> --}}
                    </div>
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
    
@endsection
