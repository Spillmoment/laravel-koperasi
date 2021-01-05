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
                                    <th>Jenis</th>
                                    <th>Nominal</th>
                                    <th>Keterangan</th>
                                    {{-- <th>Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                              @foreach ($data_simpanan as $data)
                              <tr>
                                  <td>
                                    <span class="font-weight-normal">{{ $data->created_at->format('d-m-Y') }}</span>
                                  </td>
                                  <td>
                                      <span class="font-weight-normal">{{ $data->anggota->nama_anggota }}</span>
                                  </td>
                                <td><span class="font-weight-normal">{{ ucwords($data->jenis_simpanan->nama_simpanan) }}</span></td> 
                                <td><span class="font-weight-bold">{{ $data->nominal }}</span></td>
                                  <td><span class="font-weight-bold">{{ $data->keterangan == '' ? '-' : $data->keterangan }}</span></td>
                                  {{-- <td>
                                      <div class="btn-group">
                                          <button class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                              <span class="icon icon-sm">
                                                  <span class="fas fa-ellipsis-h icon-dark"></span>
                                              </span>
                                              <span class="sr-only">Toggle Dropdown</span>
                                          </button>
                                          <div class="dropdown-menu">
                                              <a class="dropdown-item" href="{{ route('simpanan.edit', $data->id) }}"><span class="fas fa-eye mr-2"></span>View Details</a>
                                              <a class="dropdown-item" href="#"><span class="fas fa-edit mr-2"></span>Edit</a>
                                              <a class="dropdown-item text-danger" href="{{ route('simpanan.destroy', $data->id) }}" onclick="event.preventDefault();
            document.getElementById('delete-form').submit();"><span class="fas fa-trash-alt mr-2"></span>Remove</a>
                                            <form id="delete-form" action="{{ route('simpanan.destroy', $data->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('delete')
                                            </form>
                                          </div>
                                      </div>
                                  </td> --}}
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