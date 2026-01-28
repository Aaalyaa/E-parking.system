@extends(auth()->user()->layout())

@section('content')
<h3>Laporan Transaksi Harian</h3>
<p>Tanggal: {{ $tanggal->format('d-m-Y') }}</p>

<hr>

<h4>Ringkasan</h4>
<ul>
    <li>Total Transaksi: <b>{{ $totalTransaksi }}</b></li>
    <li>Total Pendapatan: <b>Rp {{ number_format($totalPendapatan) }}</b></li>
</ul>

<hr>

<h4>Breakdown Kendaraan</h4>
<table border="1" cellpadding="5">
    <tr>
        <th>Jenis Kendaraan</th>
        <th>Jumlah</th>
    </tr>
    @foreach ($kendaraan as $item)
    <tr>
        <td>{{ ucfirst($item->jenis_kendaraan) }}</td>
        <td>{{ $item->total }}</td>
    </tr>
    @endforeach
</table>

<hr>

<h4>Breakdown Metode Pembayaran</h4>
<table border="1" cellpadding="5">
    <tr>
        <th>Metode</th>
        <th>Jumlah Transaksi</th>
        <th>Total</th>
    </tr>
    @foreach ($metodeBayar as $item)
    <tr>
        <td>{{ $item->metode_bayar ?? '-' }}</td>
        <td>{{ $item->total }}</td>
        <td>Rp {{ number_format($item->nominal) }}</td>
    </tr>
    @endforeach
</table>
@endsection