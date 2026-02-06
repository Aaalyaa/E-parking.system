<!DOCTYPE html>
<html>
<head>
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

<h3 style="text-align:center">Laporan Tipe Kendaraan</h3>
<p>
    Periode:
    {{ $tanggalAwal ?? '-' }} s/d {{ $tanggalAkhir ?? '-' }}
</p>

<table>
    <thead>
        <tr>
            <th>Tipe Kendaraan</th>
            <th>Jumlah</th>
            <th>Total Revenue</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($laporan as $item)
        <tr>
            <td>{{ $item->nama_tipe }}</td>
            <td>{{ $item->jumlah }}</td>
            <td>Rp {{ number_format($item->total_revenue, 0, ',', '.') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>