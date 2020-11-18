@extends('layouts.app')

@section('title', 'Tambah Anggota')

@section('content')

<div class="row">
    <div class="col-12 mb-4">
        <div class="card border-light shadow-sm components-section">
            <div class="card-body">     
                <div class="row mb-4">
                    <div class="col-lg-4 col-sm-6">

                    <form action="{{ route('simpanan.store') }}" method="post">
                            @csrf

                            <input class="form-control basicAutoComplete" type="text" autocomplete="off">


                            <div class="mb-3">
                                <label for="anggota_id">ID Anggota</label>
                                <input type="text" class="form-control {{ $errors->first('anggota_id') ? 'is-invalid' : '' }}" id="anggota_id" name="anggota_id">
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
                                <label for="jenis_simpanan">Jenis Simpanan</label>
                                <select class="form-select" name="jenis_simpanan" id="jenis_simpanan">
                                    <option value="pokok">Pokok</option>
                                    <option value="sukarela">Sukarela</option>
                                    <option value="wajib">Wajib</option>
                                    <option value="lain">Lain-lain</option>
                                </select>
                                <div class="invalid-feedback">
                                    {{$errors->first('nominal')}}
                                </div>
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
                                <input type="submit" value="Simpan">
                                {{-- <button type="submit" class="btn btn-secondary">Simpan</button> --}}
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
{{-- <script src="https://cdn.jsdelivr.net/gh/xcash/bootstrap-autocomplete@v2.3.7/dist/latest/bootstrap-autocomplete.min.js"></script>

<script>
    $('.basicAutoComplete').autoComplete({
        resolverSettings: {
            url: 'https://gist.githubusercontent.com/cbmgit/852c2702d4342e7811c95f8ffc2f017f/raw/InsuranceCompanies.json'
        }
    });
</script> --}}

@endpush