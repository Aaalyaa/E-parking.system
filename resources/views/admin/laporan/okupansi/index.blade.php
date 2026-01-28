@extends('admin.layout')

@section('content')
<h3>Laporan Occupancy Parkir</h3>
<p class="text-muted">Kondisi slot parkir saat ini</p>

<table border="1" cellpadding="8" cellspacing="0" width="100%">
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
        @foreach ($areas as $area)
            @foreach ($area->kapasitasArea as $kapasitas)
                @php
                    $terpakai = $area->transaksiAktif
                        ->where('dataKendaraan.id_tipe_kendaraan', $kapasitas->id_tipe_kendaraan)
                        ->count();

                    $tersedia = max(0, $kapasitas->kapasitas - $terpakai);

                    $persen = $kapasitas->kapasitas > 0
                        ? round(($terpakai / $kapasitas->kapasitas) * 100, 1)
                        : 0;
                @endphp

                <tr>
                    <td>{{ $area->lokasiArea->lokasi_area }}</td>
                    <td>{{ $area->nama_area }}</td>
                    <td>{{ $kapasitas->tipeKendaraan->nama_tipe }}</td>
                    <td>{{ $kapasitas->kapasitas }}</td>
                    <td>{{ $terpakai }}</td>
                    <td>{{ $tersedia }}</td>
                    <td>{{ $persen }}%</td>
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>
@endsection
