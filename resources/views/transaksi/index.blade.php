@extends(auth()->user()->layout())

@section('content')
    <h3>Histori Transaksi Parkir</h3>
    <div class="d-flex justify-content-between align-items-center">
        <form method="GET" action="{{ route('transaksi.index') }}">
            <label>Tanggal</label>
            <input type="date" name="tanggal" value="{{ request('tanggal') }}">

            <label>Plat Nomor</label>
            <input type="text" name="plat" value="{{ request('plat') }}">

            <button type="submit">Cari</button>
            <a href="{{ route('transaksi.index') }}">Reset</a>
        </form>

        @if(auth()->user()->role->peran === 'petugas')
        <a href="{{ route('transaksi.create') }}" class="btn btn-primary">Buat Transaksi Baru</a>
        @endif
    </div>

    <br>

    <table border="1" cellpadding="5" width="100%">
        <thead>
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
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transaksis as $i => $t)
                <tr>
                    <td>{{ $transaksis->firstItem() + $i }}</td>
                    <td>{{ $t->kode }}</td>
                    <td>{{ $t->dataKendaraan->plat_nomor }}</td>
                    <td>{{ $t->area->nama_area }}</td>
                    <td>{{ $t->waktu_masuk->format('H:i') }}</td>
                    <td>{{ $t->waktu_keluar->format('H:i') }}</td>
                    <td>{{ $t->durasi_format }}</td>
                    <td>Rp {{ number_format($t->total_biaya, 0, ',', '.') }}</td>
                    <td>{{ $t->metode_bayar }}</td>
                    <td>
                        <a href="{{ route('transaksi.struk_keluar', $t->id) }}">
                            Lihat Struk
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" align="center">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <br>
    {{ $transaksis->links() }}
@endsection
