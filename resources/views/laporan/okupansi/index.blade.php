@extends(auth()->user()->layout())

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h3 class="mb-0">Laporan Occupancy Parkir</h3>
                <p class="text-muted">Tanggal: {{ $tanggal->format('d-m-Y') }}</p>
            </div>

            <a href="{{ route('laporan.okupansi.pdf') }}" class="btn btn-success">
                <i class="bi bi-file-earmark-pdf"></i> Cetak PDF
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-0">

                <table class="table table-striped table-hover mb-0">
                    <thead class="table-light">
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

                                    $persen =
                                        $kapasitas->kapasitas > 0
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

            </div>
        </div>

    </div>
@endsection
