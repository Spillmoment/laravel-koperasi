@extends('layouts.app')

@section('title', 'Tambah Pinjaman')

@section('content')

@if (session('success'))
@push('scripts')
<script>
    swal({
        title: "Good job!",
        text: "{{ session('success') }}",
        icon: "success",
        button: false,
        timer: 2000
    });

</script>
@endpush
@endif


<div class="py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item"><a href="#"><span class="fas fa-home"></span></a></li>
            <li class="breadcrumb-item"><a href="#">Pinjaman</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Pinjaman</li>
        </ol>
    </nav>

</div>

<div class="row">
    <div class="col-12 mb-4">
        <div class="card border-light shadow-sm components-section">
            <div class="card-body">
                <form action="{{ route('jenis-simpanan.store') }}" method="post">
                    @csrf
                    <div class="row mb-4">
                        <div class="col-lg-5 col-sm-6">
                            <div class="mb-3">
                                <label for="nama_simpanan">Nama Simpanan</label>
                                <input type="text"
                                    class="form-control {{ $errors->first('nama_simpanan') ? 'is-invalid' : '' }}"
                                    id="nama_simpanan" name="nama_simpanan" value="{{ old('nama_simpanan')  }}">
                                <div class="invalid-feedback">
                                    {{$errors->first('nama_simpanan')}}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="minimal_simpan">Minimal Simpan</label>
                                <input type="number"
                                    class="form-control {{ $errors->first('minimal_simpan') ? 'is-invalid' : '' }}"
                                    id="minimal_simpan" name="minimal_simpan" value="{{ old('minimal_simpan')  }}">
                                <div class="invalid-feedback">
                                    {{$errors->first('minimal_simpan')}}
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
