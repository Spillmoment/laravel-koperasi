@extends('layouts.app')

@section('title', 'Edit Simpanan')

@section('content')

<div class="row">
    <div class="col-12 mb-4">
        <div class="card border-light shadow-sm components-section">
            <div class="card-body">     
                <div class="row mb-4">
                    <div class="col-lg-4 col-sm-6">
                        <form action="/admin/simpanan/{{ $simpanan->id }}" method="post">
                            @csrf
                            @method('put')
                            <div class="mb-3">
                                <label for="anggota_id">No. KTP</label>
                                <input type="text" class="form-control" id="anggota_id" name="anggota_id" value="{{ $data_relasi->anggota->no_ktp }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="nama_anggota">Nama Anggota</label>
                                <input type="text" class="form-control" id="nama_anggota" name="nama_anggota" value="{{ $data_relasi->anggota->nama_anggota }}" readonly>
                                <div class="invalid-feedback">
                                    {{$errors->first('nama_anggota')}}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="jenis_simpanan_id">Jenis Simpanan</label>
                                <select class="form-select {{ $errors->first('jenis_simpanan_id') ? 'is-invalid' : '' }}" name="jenis_simpanan_id" id="jenis_simpanan_id">
                                    <option value="{{ $data_relasi->jenis_simpanan->id }}">{{ $data_relasi->jenis_simpanan->nama_simpanan }}</option>
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
                                <input type="text" class="form-control {{ $errors->first('nominal') ? 'is-invalid' : '' }}" id="nominal" name="nominal" value="{{ $simpanan->nominal }}">
                                <div class="invalid-feedback">
                                    {{$errors->first('nominal')}}
                                </div>
                            </div>
                            <div class="my-4">
                                <label for="textarea">Keterangan</label>
                                <textarea class="form-control {{ $errors->first('keterangan') ? 'is-invalid' : '' }}" placeholder="Tulis keterangan..." id="keterangan" name="keterangan" rows="4">{{ $simpanan->keterangan }}</textarea>
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