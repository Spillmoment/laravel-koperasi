<table class="table table-hover" id="simpananTable">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Nama Anggota</th>
            <th>Nominal</th>
            <th>Jangka Waktu</th>
            <th>Bagi Hasil</th>
            <th>Per-Bulan</th>
            <th>Keterangan</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pinjaman as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->created_at->format('d F Y') }}</td>
            <td>{{ $item->anggota->nama_anggota }}</td>
            <td>@currency($item->nominal)</td>
            <td>{{ $item->jangka_waktu }} Hari</td>
            <td>{{ $item->bagi_hasil }} %</td>
            <td>@currency($item->bayar_perbulan )</td>
            <td>{{ $item->keterangan }}</td>
            <td>{{ $item->status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
