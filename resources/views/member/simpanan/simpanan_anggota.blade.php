@extends('layouts.app')

@section('title', 'Data Anggota')

@section('content')

<div class="row">
    <div class="col-12 mb-4">
        <div class="card border-light shadow-sm components-section">
            <div class="card-body">     
                <div class="row">

                      <div class="table-settings mb-4">
                        <div class="row align-items-center justify-content-between">
                            <div class="col col-md-6 col-lg-3 col-xl-4">
                                <form action="{{ route('cari.anggota') }}" method="GET">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon2"><span class="fas fa-search"></span></span>
                                        <input type="text" class="form-control" name="cari" placeholder="Search" aria-label="Search" aria-describedby="basic-addon2">
                                        <input value="Cari" type="submit">
                                    </div>
                                </form>
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
                        <div class="col-3">
                            @if(Request::url() === route('cari.anggota'))
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No. KTP</th>
                                        <td>{{ $anggota->no_ktp }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama</th>
                                        <td>{{ $anggota->nama_anggota }}</td>
                                    </tr>
                                    @foreach ($data_simpanan as $data)
                                    <tr>
                                        <th>{{ $data->jenis_simpanan->nama_simpanan }}</th>
                                        <td>{{ $data->total_simpanan }}</td>
                                    </tr>
                                    @endforeach
                                </thead>
                            </table>
                            <br>
                            <h5>Simpanan Wajib</h5>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Nominal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($simpanan_1 as $simp1)
                                    <tr>
                                        <td>{{ $simp1->created_at->format('j F Y') }}</td>
                                        <td>{{ $simp1->nominal }}</td>
                                    </tr>                                            
                                    @endforeach
                                    <tr>
                                        <th><h6>Total</h6></th>
                                        <td>{{ $count_simpanan_1->total_simpanan }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            <h5>Simpanan Pokok</h5>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Nominal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($simpanan_2 as $simp2)
                                    <tr>
                                        <td>{{ $simp2->created_at->format('j F Y') }}</td>
                                        <td>{{ $simp2->nominal }}</td>
                                    </tr>                                            
                                    @endforeach
                                    <tr>
                                        <th><h6>Total</h6></th>
                                        <td>{{ $count_simpanan_2->total_simpanan }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            <h5>Simpanan Sukarela</h5>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Nominal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($simpanan_3 as $simp3)
                                    <tr>
                                        <td>{{ $simp3->created_at->format('j F Y') }}</td>

                                        <td class="{{ $simp3->nominal < 0 ? 'text-danger' : '' }}">{{ $simp3->nominal }}</td>
                                    </tr>                                            
                                    @endforeach
                                    <tr>
                                        <th><h6>Total</h6></th>
                                        <td>{{ $count_simpanan_3->total_simpanan }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            @endif
                        </div>
                      </div>
                    <footer class="footer section py-2">

                </div>
                
            </div>
        </div>
    </div>
</div>
    
@endsection