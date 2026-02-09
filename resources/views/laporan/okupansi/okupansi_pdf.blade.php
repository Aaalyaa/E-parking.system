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

<h3 style="text-align:center">LAPORAN OKUPANSI PARKIR</h3>
<p>Tanggal: {{ $waktu->format('d-m-Y H:i') }}</p>

<table>
    <thead>
        <tr>
            <th>Lokasi</th>
            <th>Area</th>
            <th>Tipe Kendaraan</th>
            <th>Kapasitas</th>
            <th>Terpakai</th>
            <th>Tersedia</th>
            <th>Occupancy (%)</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $row)
        <tr>
            <td>{{ $row['lokasi'] }}</td>
            <td>{{ $row['area'] }}</td>
            <td>{{ $row['tipe'] }}</td>
            <td>{{ $row['kapasitas'] }}</td>
            <td>{{ $row['terpakai'] }}</td>
            <td>{{ $row['tersedia'] }}</td>
            <td>{{ $row['persen'] }}%</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>