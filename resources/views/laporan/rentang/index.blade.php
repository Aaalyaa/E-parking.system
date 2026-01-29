@extends(auth()->user()->layout())

@section('content')
<h3>Laporan Rentang Tanggal</h3>

<form method="GET" action="{{ route('laporan.rentang') }}" class="mb-3">
    <label>Tanggal Mulai</label>
    <input type="date" name="tanggal_mulai" required>

    <label>Tanggal Akhir</label>
    <input type="date" name="tanggal_akhir" required>

    <button class="btn btn-primary" type="submit">Tampilkan</button>
    <a href="{{ route('laporan.rentang') }}" class="btn btn-danger">Reset</a>
</form>

@if(isset($transaksi))
<hr>

<a href="{{ route('laporan.rentang.pdf', request()->query()) }}"
   class="btn btn-sm btn-success mb-3">
   Cetak PDF
</a>

<h4>Detail Transaksi</h4>

<table class="table table-bordered table-striped">
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
@endif
@endsection