@extends(auth()->user()->layout())

@section('content')
    <x-page-header title="Laporan Tipe Kendaraan" subtitle="Breakdown jumlah & revenue" :action-route="route('laporan.tipe-kendaraan.pdf', request()->query())"
        action-label="Cetak PDF" action-class="btn-success" />

    <x-page.filter>
        <form method="GET" class="row g-2">
            <div class="col-md-4">
                <input type="date" name="tanggal_awal" value="{{ $tanggalAwal }}" class="form-control">
            </div>
            <div class="col-md-4">
                <input type="date" name="tanggal_akhir" value="{{ $tanggalAkhir }}" class="form-control">
            </div>
            <div class="col-md-2">
                <button class="btn btn-outline-primary w-100">Filter</button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('laporan.tipe-kendaraan') }}" class="btn btn-outline-secondary w-100">
                    Reset
                </a>
            </div>
        </form>
    </x-page.filter>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-sm">
                <thead class="table-dark">
                    <tr>
                        <th>Tipe Kendaraan</th>
                        <th>Jumlah Kendaraan</th>
                        <th>Total Revenue</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($laporan as $item)
                        <tr>
                            <td>{{ ucfirst($item->nama_tipe) }}</td>
                            <td>{{ $item->jumlah }}</td>
                            <td>Rp {{ number_format($item->total_revenue, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
