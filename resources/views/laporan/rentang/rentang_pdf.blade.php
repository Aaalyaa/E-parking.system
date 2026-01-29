<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Okupansi</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 5px;
            text-align: center;
        }
        th {
            background: #eee;
        }
    </style>
</head>
<body>

<h3 style="text-align:center">LAPORAN TRANSAKSI RENTANG TANGGAL</h3>
<p>Tanggal: {{ $mulai->format('d-m-Y H:i') }} s.d. {{ $akhir->format('d-m-Y H:i') }}</p>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Plat</th>
            <th>Tipe Kendaraan</th>
            <th>Metode Bayar</th>
            <th>Total Biaya</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transaksi as $i => $item)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $item->waktu_keluar->format('d-m-Y H:i') }}</td>
            <td>{{ $item->dataKendaraan->plat_nomor }}</td>
            <td>{{ $item->dataKendaraan->tipe_kendaraan->nama_tipe }}</td>
            <td>{{ $item->metode_bayar }}</td>
            <td>Rp {{ number_format($item->total_biaya) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>