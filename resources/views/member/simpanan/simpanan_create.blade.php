@extends('layouts.app')

@section('title', 'Tambah Simpanan')

@section('content')

<div class="row">
    <div class="col-12 mb-4">
        <div class="card border-light shadow-sm components-section">
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-lg-4 col-sm-6">
                        <form action="{{ route('simpanan.store') }}" method="post">
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
                                <input type="text"
                                    class="form-control {{ $errors->first('nama_anggota') ? 'is-invalid' : '' }}"
                                    id="nama_anggota" name="nama_anggota">
                                <div class="invalid-feedback">
                                    {{$errors->first('nama_anggota')}}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="jenis_simpanan_id">Jenis Simpanan</label>
                                <select class="form-select {{ $errors->first('jenis_simpanan_id') ? 'is-invalid' : '' }}" name="jenis_simpanan_id" id="jenis_simpanan_id">
                                    <option value=""></option>
                                    @foreach ($data_jenis_simpanan as $jensim)
                                    <option value="{{ $jensim->id }}">{{ $jensim->nama_simpanan }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    {{$errors->first('jenis_simpanan_id')}}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="nominal">Jumlah</label>
                                <input type="text"
                                    class="form-control {{ $errors->first('nominal') ? 'is-invalid' : '' }}"
                                    id="nominal" name="nominal">
                                <div class="invalid-feedback">
                                    {{$errors->first('nominal')}}
                                </div>
                            </div>
                            <div class="my-4">
                                <label for="textarea">Keterangan</label>
                                <textarea class="form-control {{ $errors->first('keterangan') ? 'is-invalid' : '' }}"
                                    placeholder="Tulis keterangan..." id="keterangan" name="keterangan"
                                    rows="4"></textarea>
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
    function select() {
        var d = document.getElementById("anggota_id");
        var displayText = d.options[d.selectedIndex].text.slice(0, -18);
        document.getElementById("nama_anggota").value = displayText;
    }


</script>
@endpush
