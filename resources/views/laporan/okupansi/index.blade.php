@extends(auth()->user()->layout())

@section('content')
    <x-page-header title="Laporan Okupansi Parkir" :subtitle="'Tanggal: ' . $waktu->format('d-m-Y H:i')" :action-route="route('laporan.okupansi.pdf')" action-label="Cetak PDF"
        action-class="btn-success" />

    <x-table.wrapper>
        <x-table.thead>
            <tr>
                <th>Lokasi</th>
                <th>Area</th>
                <th>Tipe Kendaraan</th>
                <th>Kapasitas</th>
                <th>Terpakai</th>
                <th>Tersedia</th>
                <th>Occupancy (%)</th>
            </tr>
        </x-table.thead>
        <tbody>
            @foreach ($areas as $area)
                @foreach ($area->kapasitasArea as $kapasitas)
                    @php
                        $terpakai = $area->transaksiAktif
                            ->where('dataKendaraan.id_tipe_kendaraan', $kapasitas->id_tipe_kendaraan)
                            ->count();

                        $tersedia = max(0, $kapasitas->kapasitas - $terpakai);

                        $persen = $kapasitas->kapasitas > 0 ? round(($terpakai / $kapasitas->kapasitas) * 100, 1) : 0;
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
    </x-table.wrapper>
@endsection
