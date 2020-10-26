@extends('layouts.app')

@section('title', 'Tambah Anggota')

@section('content')

<div class="row">
    <div class="col-12 mb-4">
        <div class="card border-light shadow-sm components-section">
            <div class="card-body">     
                <div class="row mb-4">
                    <div class="col-lg-4 col-sm-6">
                        <!-- Form -->
                        <div class="mb-3">
                            <label for="ktp">No. KTP</label>
                            <input type="text" class="form-control" id="no_ktp" name="no_ktp">
                        </div>
                        <div class="mb-3">
                            <label for="nama_anggota">Nama Anggota</label>
                            <input type="text" class="form-control" id="nama_anggota" name="nama_anggota">
                        </div>
                        <div class="mb-3">
                            <fieldset>
                                <label for="jenkel">Jenis Kelamin</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="radio_laki" value="laki-laki" checked>
                                    <label class="form-check-label" for="radio_laki">
                                    Laki-laki
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="radio_perempuan" value="perempuan">
                                    <label class="form-check-label" for="radio_perempuan">
                                    Perempuan
                                    </label>
                                </div>
                            </fieldset>
                        </div>
                        <div class="my-4">
                            <label for="textarea">Alamat</label>
                            <textarea class="form-control" placeholder="Tulis alamat lengkap..." id="alamat" name="alamat" rows="4"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="kota">Kota</label>
                            <div class="input-group">
                                <span class="input-group-text"><span class="fas fa-building"></span></span>
                                <input type="text" class="form-control" id="kota" name="kota">
                            </div>
                            
                        </div>
                        <div class="mb-3">
                            <label for="telepon">Telepon</label>
                            <div class="input-group">
                                <span class="input-group-text"><span class="fas fa-phone"></span></span>
                                <input type="text" class="form-control" id="telepon" name="telepon">
                            </div>
                        </div>
                        <div class="mb-3">
                            <fieldset>
                                <label for="jenkel">Kepengurusan</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kepengurusan" value="" checked>
                                    <label class="form-check-label" for="radio_laki">
                                    Bukan Pengurus
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kepengurusan" value="">
                                    <label class="form-check-label" for="radio_perempuan">
                                    Pengurus
                                    </label>
                                </div>
                            </fieldset>
                        </div>
                        <div class="mb-3">
                            <label for="simpanan_wajib">Simpanan Wajib</label>
                            <input type="text" class="form-control" id="simpanan_wajib" name="simpanan_wajib" disabled value="1xxx000">
                            <small class="form-text text-muted">Sebagai syarat tanda keanggotan</small>
                        </div>
                        <!-- End of Form -->
                        
                    </div>
                    <div class="col-lg-4 col-sm-6">

                        <!-- Form -->
                        <div class="my-4">
                            <label for="textarea">Example textarea</label>
                            <textarea class="form-control" placeholder="Enter your message..." id="textarea" rows="4"></textarea>
                        </div>
                        <!-- End of Form -->
                        <!-- Form -->
                        <div class="mb-4">
                            <label for="usernameValidate">Username</label>
                            <input type="text" class="form-control is-invalid" id="usernameValidate" required>
                            <div class="invalid-feedback">
                                Please choose a username.
                            </div>               
                        </div>
                        <!-- End of Form -->
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="mb-3">
                            <label for="birthday">Birthday</label>
                            <div class="input-group">
                                <span class="input-group-text"><span class="far fa-calendar-alt"></span></span>
                                <input data-datepicker="" class="form-control" id="birthday" type="text" placeholder="dd/mm/yyyy" required>                                               
                            </div>
                        </div>
                        <!-- Form -->
                        <div class="mb-3">
                            <label for="disabledTextInput">Name</label>
                            <input type="text" id="disabledTextInput" class="form-control" placeholder="Disabled input" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="disabledSelect">Disabled select menu</label>
                            <select id="disabledSelect" class="form-control" disabled>
                            <option>Disabled select</option>
                            </select>
                        </div>
                        <!-- End of Form -->
                        <!-- Form -->
                        <div class="mb-4">
                            <label class="my-1 mr-2" for="country">Country</label>
                            <select class="form-select" id="country" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <!-- End of Form -->
                        <!-- Form -->
                        <div class="form-file mb-3">
                            <input type="file" class="form-file-input" id="customFile">
                            <label class="form-file-label" for="customFile">
                                <span class="form-file-text">Choose file...</span>
                                <span class="form-file-button">Browse</span>
                            </label>
                        </div>
                        <!-- End of Form -->
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
    
@endsection