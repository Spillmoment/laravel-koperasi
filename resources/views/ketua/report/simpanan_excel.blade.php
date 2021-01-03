<table class="table table-hover" id="simpananTable">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>ID Anggota</th>
            <th>Nama Anggota</th>
            <th>Jenis Simpanan</th>
            <th>Nominal</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($simpanan as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->created_at->format('d F Y') }}</td>
            <td>{{ $item->anggota->id }}</td>
            <td>{{ $item->anggota->nama_anggota }}</td>
            <td>{{ $item->jenis_simpanan->nama_simpanan }}</td>
            <td>@currency($item->nominal)</td>
        </tr>
        @endforeach
    </tbody>
</table>
