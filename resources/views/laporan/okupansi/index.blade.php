@extends(auth()->user()->layout())

@section('content')
    <x-page-header title="Laporan Okupansi Parkir" :subtitle="'Tanggal: ' . $tanggal->format('d-m-Y')" :action-route="route('laporan.okupansi.pdf')" action-label="Cetak PDF"
        action-class="btn-success" />

    <x-page.filter>
        <form method="GET" action="{{ route('laporan.okupansi') }}" class="row g-2">
            <div class="col-md-6">
                <input type="date" name="tanggal" value="{{ request('tanggal', $tanggal->format('Y-m-d')) }}"
                    class="form-control">
            </div>

            <div class="col-md-3">
                <button class="btn btn-outline-primary w-100">
                    Filter
                </button>
            </div>

            <div class="col-md-3">
                <a href="{{ route('laporan.okupansi') }}" class="btn btn-outline-secondary w-100">
                    Reset
                </a>
            </div>
        </form>
    </x-page.filter>

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
