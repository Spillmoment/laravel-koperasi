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
            <div class="card-body">
                <div class="row">

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>ID Anggota</th>
                                <th>Nama Anggota</th>
                                <th>Nominal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($simpanan as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->created_at->format('d F Y') }}</td>
                                <td>{{ $item->anggota->id }}</td>
                                <td>{{ $item->anggota->nama_anggota }}</td>
                                <td>@currency($item->nominal)</td>
                                <td>
                                    <div class="btn-group">
                                        <button
                                            class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="icon icon-sm">
                                                <span class="fas fa-ellipsis-h icon-dark"></span>
                                            </span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                                href="{{ route('simpanan.show', $item->id) }}"><span
                                                    class="fas fa-eye mr-2"></span>Details</a>
                                            <a class="dropdown-item text-danger"
                                                href="{{ route('anggota.destroy', $item->id) }}" onclick="event.preventDefault();
                                        document.getElementById('delete-form').submit();"><span
                                                    class="fas fa-trash-alt mr-2"></span>Remove</a>
                                            <form id="delete-form" action="{{ route('simpanan.destroy', $item->id) }}"
                                                method="POST" style="display: none;">
                                                @csrf
                                                @method('delete')
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <footer class="footer section py-2">

                </div>

            </div>
        </div>
    </div>
</div>

@endsection
