@extends('layouts.app')

@section('title', 'Detail Pinjaman')

@section('content')

<div class="row">
    <div class="col-12 mb-4">
        <div class="card border-light shadow-sm components-section">
            <div class="card-body">     
                <div class="row mb-4">
                    <div class="col-lg-4 col-sm-6">
                        <h4>Detail Pinjaman</h4>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Jumlah Pinjaman</th>
                                    <td>{{ $data_pinjaman->nominal }}</td>
                                </tr>
                                <tr>
                                    <th>Bayar Pokok </th>
                                    <td>{{ $data_pinjaman->bayar_pokok }}%</td>
                                </tr>
                                <tr>
                                    <th>Jangka Waktu</th>
                                    <td>{{ $data_pinjaman->jangka_waktu }} bulan</td>
                                </tr>
                                <tr>
                                    <th>Bagi hasil</th>
                                    <td>{{ $data_pinjaman->bagi_hasil }}% ( {{ $data_pinjaman->hasil_bagi }} )</td>
                                </tr>
                                <tr>
                                    <th>Perbulan</th>
                                    <td>{{ $data_pinjaman->bayar_perbulan }}</td>
                                </tr>
                                <tr>
                                    <th>Total</th>
                                    <td>{{ $data_pinjaman->total }}</td>
                                </tr>
                                <tr>
                                    <th>Status Pinjaman</th>
                                    <td>{{ $data_pinjaman->status }}</td>
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
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
    
@endsection