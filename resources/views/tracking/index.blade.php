@extends(auth()->user()->layout())

@section('content')
<h3>Kendaraan Sedang Parkir</h3>

<table border="1" cellpadding="5">
    <thead>
        <tr>
            <th>No</th>
            <th>Plat</th>
            <th>Tipe</th>
            <th>Area</th>
            <th>Waktu Masuk</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($parkirAktif as $i => $transaksi)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $transaksi->dataKendaraan->plat_nomor }}</td>
                <td>{{ $transaksi->dataKendaraan->tipe_kendaraan->nama_tipe }}</td>
                <td>{{ $transaksi->area->nama_area }}</td>
                <td>{{ $transaksi->waktu_masuk->format('d-m-Y H:i') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection