@extends(auth()->user()->layout())

@section('content')

    <x-page-header title="Laporan Rentang Tanggal" />

    <x-page.filter>
        <form method="GET" action="{{ route('laporan.rentang') }}">
            <div class="row g-3">
                <div class="col-md-6">
                    <x-form.input type="date" name="tanggal_mulai" label="Tanggal Mulai" :value="request('tanggal_mulai')" required />
                </div>

                <div class="col-md-6">
                    <x-form.input type="date" name="tanggal_akhir" label="Tanggal Akhir" :value="request('tanggal_akhir')" required />
                </div>
            </div>

            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-primary">
                    Tampilkan
                </button>

                <a href="{{ route('laporan.rentang') }}" class="btn btn-outline-secondary">
                    Reset
                </a>
            </div>
        </form>
    </x-page.filter>

    @isset($transaksi)
        <x-page-header title="Detail Transaksi" :action-route="route('laporan.rentang.pdf', request()->query())" action-label="Cetak PDF" action-class="btn-success" />

        <x-table.wrapper>
            <x-table.thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Plat</th>
                    <th>Tipe Kendaraan</th>
                    <th>Metode Bayar</th>
                    <th>Total Biaya</th>
                </tr>
            </x-table.thead>
            <tbody>
                @foreach ($transaksi as $i => $item)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $item->waktu_keluar->format('d-m-Y H:i') }}</td>
                        <td>{{ $item->dataKendaraan->plat_nomor }}</td>
                        <td>{{ $item->dataKendaraan->tipe_kendaraan->nama_tipe }}</td>
                        <td>{{ $item->metode_bayar }}</td>
                        <td>
                            Rp {{ number_format($item->total_biaya, 0, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </x-table.wrapper>
    @endisset

@endsection
