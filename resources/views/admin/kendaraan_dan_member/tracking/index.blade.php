@extends('admin.layout')

@section('content')
        <h1>Tracking Kendaraan</h1>

        <table border="1">
            <thead>
                <tr>
                    <th>Lokasi</th>
                    <th>Nama Area</th>
                    <th>Tipe Kendaraan</th>
                    <th>Kapasitas Area</th>
                    <th>Jumlah Tempat Terpakai</th>
                    <th>Tempat yang Tersedia</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($areas as $area)
                    @foreach ($area->kapasitasArea as $kapasitas)
                        @php
                            $terpakai = $area->transaksiAktif
                                ->where('dataKendaraan.id_tipe_kendaraan', $kapasitas->id_tipe_kendaraan)
                                ->count();

                            $tersedia = max(0, $kapasitas->kapasitas - $terpakai);
                        @endphp

                    <tr>
                        <td>{{ $area->lokasiArea->lokasi_area }}</td>
                        <td>{{ $area->nama_area }}</td>
                        <td>{{ $kapasitas->tipeKendaraan->nama_tipe }}</td>
                        <td>{{ $kapasitas->kapasitas }}</td>
                        <td>{{ $terpakai }}</td>
                        <td>{{ $tersedia }}</td>
                    </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
@endsection