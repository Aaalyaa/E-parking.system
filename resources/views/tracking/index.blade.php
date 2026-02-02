@extends(auth()->user()->layout())

@section('content')
    <x-page-header title="Kendaraan yang Sedang Parkir" :action-route="$canCreate ? route('transaksi.keluar.create') : null" action-label="Buat Transaksi Keluar" />

    <x-page.filter>
        <form method="GET" action="{{ route('tracking.index') }}">
            <div class="row g-2 align-items-end">
                <div class="col-md-4">
                    <label class="form-label">Plat Nomor</label>
                    <input type="text" name="plat" value="{{ request('plat') }}" class="form-control"
                        placeholder="Contoh: L 1234 AB">
                </div>

                <div class="col-md-6 d-flex gap-2">
                    <button class="btn btn-primary">
                        Filter
                    </button>
                    <a href="{{ route('tracking.index') }}" class="btn btn-secondary">
                        Reset
                    </a>
                </div>
            </div>
        </form>
    </x-page.filter>

    <x-table.wrapper>
        <x-table.thead>
            <tr>
                <th>No</th>
                <th>Plat</th>
                <th>Tipe</th>
                <th>Lokasi</th>
                <th>Area</th>
                <th>Waktu Masuk</th>
            </tr>
        </x-table.thead>
        <tbody>
            @forelse ($parkirAktif as $i => $transaksi)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $transaksi->dataKendaraan->plat_nomor }}</td>
                    <td>{{ $transaksi->dataKendaraan->tipe_kendaraan->nama_tipe }}</td>
                    <td>{{ $transaksi->area->lokasiArea->lokasi_area }}</td>
                    <td>{{ $transaksi->area->nama_area }}</td>
                    <td>{{ $transaksi->waktu_masuk->format('d-m-Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center">
                        Tidak ada kendaraan yang sedang parkir.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </x-table.wrapper>
@endsection
