@extends('layouts.app')

@section('title', 'Penarikan Simpanan')

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

@if ($message = Session::get('error'))
@push('scripts')
<script>
    swal({
        title: "Gagal!",
        text: "{{ session('error') }}",
        icon: "error",
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
                <div class="row mb-4">
                    <div class="col-lg-4 col-sm-6">
                        <h4>Penarikan Simpanan</h4>
                        <form action="{{ route('simpanan.penarikan.post') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="anggota_id">ID Anggota</label>
                                {{-- <input type="text" class="form-control {{ $errors->first('anggota_id') ? 'is-invalid' : '' }}" id="anggota_id" name="anggota_id"> --}}
                                <select class="form-select {{ $errors->first('anggota_id') ? 'is-invalid' : '' }}" name="anggota_id" id="anggota_id">
                                    <option value=""></option>
                                    @foreach ($data_anggota as $anggota)
                                    <option value="{{ $anggota->id }}">{{ $anggota->nama_anggota }} - {{ $anggota->no_ktp }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    {{$errors->first('anggota_id')}}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="nama_anggota">Nama Anggota</label>
                                <input type="text" class="form-control {{ $errors->first('nama_anggota') ? 'is-invalid' : '' }}" id="nama_anggota" name="nama_anggota">
                                <div class="invalid-feedback">
                                    {{$errors->first('nama_anggota')}}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="jenis_simpanan_id">Jenis Simpanan</label>
                                <input type="text" class="form-control" value="Simpanan Sukarela" readonly disabled>
                                
                            </div>
                            <div class="mb-3">
                                <label for="nominal">Jumlah</label>
                                <input type="text" class="form-control {{ $errors->first('nominal') ? 'is-invalid' : '' }}" id="nominal" name="nominal">
                                <div class="invalid-feedback">
                                    {{$errors->first('nominal')}}
                                </div>
                            </div>
                            <div class="my-4">
                                <label for="textarea">Keterangan</label>
                                <textarea class="form-control {{ $errors->first('keterangan') ? 'is-invalid' : '' }}" placeholder="Tulis keterangan..." id="keterangan" name="keterangan" rows="4"></textarea>
                                <div class="invalid-feedback">
                                    {{$errors->first('keterangan')}}
                                </div>
                            </div>
                            <div class="mb-3">
                                {{-- <input type="submit" value="Simpan"> --}}
                                <button type="submit" class="btn btn-secondary">Simpan</button>
                            </div>
                        </form>
                        
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
    
@endsection

@push('scripts')
    <script>
        document.getElementById("anggota_id").addEventListener("change", function(e) {
            let get_anggota = this.options[this.selectedIndex].text.slice(0, -6); 
            document.getElementById("nama_anggota").value = get_anggota;
        });

    </script>

@endpush