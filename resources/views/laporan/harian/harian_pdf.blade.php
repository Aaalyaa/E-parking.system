<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Transaksi Harian</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
        }

        h3,
        h4 {
            margin-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
            text-align: center;
        }

        th {
            background-color: #eee;
        }

        .summary td {
            text-align: left;
        }
    </style>
</head>

<body>

    <h3 style="text-align:center">LAPORAN TRANSAKSI HARIAN</h3>
    <p>Tanggal: {{ $tanggal->format('d-m-Y') }}</p>

    <hr>

    <h4>Ringkasan</h4>
    <table class="summary">
        <tr>
            <td width="30%">Total Transaksi</td>
            <td width="70%">: {{ $totalTransaksi }}</td>
        </tr>
        <tr>
            <td>Total Pendapatan</td>
            <td>: Rp {{ number_format($totalPendapatan) }}</td>
        </tr>
    </table>

    <h4>Breakdown Per Tipe Kendaraan</h4>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tipe Kendaraan</th>
                <th>Jumlah Transaksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kendaraan as $i => $item)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $item->nama_tipe }}</td>
                    <td>{{ $item->total }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h4>Breakdown Per Metode Pembayaran</h4>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Metode Pembayaran</th>
                <th>Jumlah Transaksi</th>
                <th>Total Nominal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($metodeBayar as $i => $item)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $item->metode_bayar ?? '-' }}</td>
                    <td>{{ $item->total }}</td>
                    <td>Rp {{ number_format($item->nominal) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
