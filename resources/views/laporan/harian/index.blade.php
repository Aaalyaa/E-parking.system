@extends(auth()->user()->layout())

@section('content')
    <x-page-header title="Laporan Transaksi" :subtitle="'Tanggal: ' . $tanggal->format('d-m-Y')" :action-route="route('laporan.harian.pdf')" action-label="Cetak PDF"
        action-class="btn-success" />

        <x-page.filter>
            <form method="GET" class="row g-2">
                <div class="col-md-6">
                    <input type="date" name="tanggal" value="{{ $tanggal->format('Y-m-d') }}" class="form-control">
                </div>
                <div class="col-md-3">
                    <button class="btn btn-outline-primary w-100">Filter</button>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('laporan.harian') }}" class="btn btn-outline-secondary w-100">
                        Reset
                    </a>
                </div>
            </form>
        </x-page.filter>

    <div class="card mb-3">
        <div class="card-body">
            <h5 class="fw-bold">Ringkasan</h5>
            <ul class="mb-0">
                <li>Total Transaksi: <b>{{ $totalTransaksi }}</b></li>
                <li>Total Pendapatan: <b>Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</b></li>
            </ul>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <h5 class="fw-bold">Breakdown Tipe Kendaraan</h5>
            <table class="table table-bordered table-sm">
                <thead class="table-dark">
                    <tr>
                        <th>Tipe Kendaraan</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kendaraan as $item)
                        <tr>
                            <td>{{ ucfirst($item->nama_tipe) }}</td>
                            <td>{{ $item->total }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-center">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="fw-bold">Breakdown Metode Pembayaran</h5>
            <table class="table table-bordered table-sm">
                <thead class="table-dark">
                    <tr>
                        <th>Metode</th>
                        <th>Jumlah Transaksi</th>
                        <th>Total Nominal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($metodeBayar as $item)
                        <tr>
                            <td>{{ ucfirst($item->metode_bayar ?? '-') }}</td>
                            <td>{{ $item->total }}</td>
                            <td>Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
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
