@extends(auth()->user()->layout())

@section('content')
    <x-page-header title="Kendaraan yang Sedang Parkir" />

    <x-table.wrapper>
        <x-table.thead>
            <tr>
                <th>No</th>
                <th>Plat</th>
                <th>Tipe</th>
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
                    <td>{{ $transaksi->area->nama_area }}</td>
                    <td>{{ $transaksi->waktu_masuk->format('d-m-Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center">
                        Tidak ada data
                    </td>
                </tr>
            @endforelse
        </tbody>
    </x-table.wrapper>
@endsection
