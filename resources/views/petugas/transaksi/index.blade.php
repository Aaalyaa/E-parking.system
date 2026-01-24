@extends('petugas.layout')

@section('content')
<h3>Transaksi Kendaraan Masuk</h3>

@if (session('error'))
    <div style="color:red">{{ session('error') }}</div>
@endif
@if (session('success'))
    <div style="color:green">{{ session('success') }}</div>
@endif

<form action="{{ route('petugas.transaksi.masuk') }}" method="POST">
    @csrf

    <label>Kendaraan</label>
    <select name="id_data_kendaraan" required>
        <option value="">-- Pilih Kendaraan --</option>
        @foreach ($dataKendaraan as $kendaraan)
            <option value="{{ $kendaraan->id }}">
                {{ $kendaraan->plat_nomor }} - {{ $kendaraan->tipe_kendaraan->nama_tipe }}
            </option>
        @endforeach
    </select>

    <br><br>

    <label>Area Parkir</label>
    <select name="id_area" required>
        <option value="">-- Pilih Area --</option>
        @foreach ($areas as $area)
            <option value="{{ $area->id }}">{{ $area->nama_area }} - {{ $area->lokasiArea->lokasi_area }}</option>
        @endforeach
    </select>

    <br><br>

    <button type="submit">SIMPAN MASUK</button>
</form>

<hr>

<h3>Kendaraan Sedang Parkir</h3>

<table border="1" cellpadding="5">
    <thead>
        <tr>
            <th>No</th>
            <th>Plat</th>
            <th>Tipe</th>
            <th>Area</th>
            <th>Waktu Masuk</th>
            <th>Aksi</th>
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
                <td>
                    <form action="{{ route('petugas.transaksi.keluar', $transaksi->id) }}" method="POST">
                        @csrf

                        <select name="metode_bayar" required>
                            <option value="">-- Pilih Metode --</option>
                            <option value="TUNAI">TUNAI</option>
                            <option value="DEBIT">DEBIT</option>
                            <option value="E-WALLET">E-WALLET</option>
                        </select>

                        <button type="submit">KELUAR</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection