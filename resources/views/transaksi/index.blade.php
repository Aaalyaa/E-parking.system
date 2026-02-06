@extends(auth()->user()->layout())

@section('content')
    <x-page-header title="Histori Transaksi Parkir" :action-route="$canCreate ? route('transaksi.masuk.create') : null" action-label="Buat Transaksi Masuk" />

    <x-page.filter>
        <form method="GET" action="{{ route('transaksi.index') }}" class="row g-2">
            <div class="col-md-4">
                <input type="date" name="tanggal" class="form-control" value="{{ request('tanggal') }}"
                    placeholder="Tanggal">
            </div>

            <div class="col-md-4">
                <input type="text" name="plat" class="form-control" value="{{ request('plat') }}"
                    placeholder="Plat Nomor">
            </div>

            <div class="col-md-4 d-flex gap-2">
                <button class="btn btn-outline-primary w-100">
                    Filter
                </button>
                <a href="{{ route('transaksi.index') }}" class="btn btn-outline-secondary w-100">
                    Reset
                </a>
            </div>
        </form>
    </x-page.filter>

    <x-table.wrapper>
        <x-table.thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Plat</th>
                <th>Area</th>
                <th>Masuk</th>
                <th>Keluar</th>
                <th>Durasi</th>
                <th>Total</th>
                <th>Metode</th>
                <th width="120">Aksi</th>
            </tr>
        </x-table.thead>
        <tbody>
            @forelse ($transaksis as $i => $t)
                <tr>
                    <td>{{ $transaksis->firstItem() + $i }}</td>
                    <td>{{ $t->kode }}</td>
                    <td>{{ $t->plat_nomor }}</td>
                    <td>{{ $t->area->nama_area }}</td>
                    <td>{{ $t->waktu_masuk->format('H:i') }}</td>
                    <td>{{ $t->waktu_keluar->format('H:i') }}</td>
                    <td>{{ $t->durasi_format }}</td>
                    <td>
                        Rp {{ number_format($t->total_biaya, 0, ',', '.') }}
                    </td>
                    <td>{{ $t->metode_bayar }}</td>
                    <td>
                        <a href="{{ route('transaksi.struk_keluar', $t->id) }}" class="btn btn-sm btn-info">
                            Lihat Struk
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center">
                        Tidak ada data
                    </td>
                </tr>
            @endforelse
        </tbody>
        </table>
    </x-table.wrapper>

    {{ $transaksis->withQueryString()->links('pagination::bootstrap-5') }}
@endsection
