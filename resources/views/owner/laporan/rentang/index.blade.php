@extends('owner.layout')

@section('content')
<h3>Laporan Rentang Tanggal</h3>

<form method="GET" action="{{ route('owner.laporan.rentang') }}" class="mb-3">
    <label>Tanggal Mulai</label>
    <input type="date" name="tanggal_mulai" required>

    <label>Tanggal Akhir</label>
    <input type="date" name="tanggal_akhir" required>

    <button type="submit">Tampilkan</button>
</form>

@if(isset($totalTransaksi))
<hr>

<p>
    Periode:
    <b>{{ $mulai->format('d-m-Y') }}</b>
    s/d
    <b>{{ $akhir->format('d-m-Y') }}</b>
</p>

<ul>
    <li>Total Transaksi: <b>{{ $totalTransaksi }}</b></li>
    <li>Total Pendapatan: <b>Rp {{ number_format($totalPendapatan) }}</b></li>
</ul>
@endif
@endsection