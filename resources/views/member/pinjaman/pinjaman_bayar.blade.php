@extends('layouts.app')

@section('title', 'Detail Pinjaman')

@section('content')

<div class="row">
    <div class="col-12 mb-4">
        <div class="card border-light shadow-sm components-section">
            <div class="card-body">     
                <div class="row mb-4">

                    <div class="col-md-4">
                        <h4>Detail Pinjaman</h4>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Jumlah Pinjaman</th>
                                    <td> @currency($data_pinjaman->nominal) </td>
                                </tr>
                                <tr>
                                    <th>Bayar Pokok </th>
                                    <td> @currency($data_pinjaman->bayar_pokok) </td>
                                </tr>
                                <tr>
                                    <th>Jangka Waktu</th>
                                    <td>{{ $data_pinjaman->jangka_waktu }} bulan</td>
                                </tr>
                                <tr>
                                    <th>Bagi hasil</th>
                                </tr>
                                <tr>
                                    <th>Perbulan</th>
                                    <td> @currency($data_pinjaman->bayar_perbulan)</td>
                                </tr>
                                <tr>
                                    <th>Total</th>
                                    <td> @currency($data_pinjaman->total) </td>
                                </tr>
                                <tr>
                                    <th>Status Pinjaman</th>
                                    <td>
                                        @if ($data_pinjaman->status == 'belum_lunas')
                                            <span class="text-danger">BELUM LUNAS</span>
                                        @else
                                            <span>LUNAS</span>
                                        @endif
                                        </td>
                                </tr>
                                <tr>
                                    <th>Keterangan</th>
                                    <td>-</td>
                                </tr>
                            </thead>
                        </table> 
                        <br>
                        
                    </div>
                </div>
                
                <h4>Histori Pembayaran Angsuran</h4>

                <table class="table">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Jatuh Tempo</th>
                            <th>Tanggal Bayar</th>
                            <th>Nominal</th>
                            <th>Denda</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detail_pinjaman as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $data->jatuh_tempo }}</td>
                            <td>{{ $data->tanggal_bayar }}</td>
                            <td>{{ $data->nominal }}</td>
                            <td>{{ $data->denda }}</td>
                            <td>{{ $data->keterangan }}</td>
                            <td><button type="submit" class="btn btn-sm btn-primary"><span class="fa fa-usd"></span> Bayar</button></td>
                        </tr>
                            
                        @endforeach
                            <td>{{ $data->tanggal_bayar != null ? $data->nominal : '-' }}</td>
                            <td>{{ $data->tanggal_bayar != null ? $data->denda : '-' }}</td>
                            <td>{{ $data->keterangan != null ? $data->keterangan : '-' }}</td>
                            <td>
                                @if ($data->tanggal_bayar == null)
                                    <a href="{{ route('pinjaman.bayar.detail', ['id' => $data_pinjaman->id, 'bayarpinjamid' => $data->id]) }}" class="btn btn-sm btn-primary">Bayar</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td></td>
                            <td></td>
                            <td><h4>Total</h4></td>
                            <td><h5>@currency($total_bayar)</h5></td>
                            <td>
                                @if( $count_sudah_bayar == $data_pinjaman->jangka_waktu)
                                    <button class="btn btn-sm btn-success" type="button">LUNAS</button>
                                @endif
                            </td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
    
@endsection