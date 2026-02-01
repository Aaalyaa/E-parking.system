@extends(auth()->user()->layout())
@section('content')
    <div class="container-fluid">

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <small class="text-muted">Transaksi Hari Ini</small>
                    <h3 class="fw-bold">{{ $totalTransaksi }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <small class="text-muted">Pendapatan Hari Ini</small>
                    <h3 class="fw-bold">
                        Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <small class="text-muted">Rata-rata / Transaksi</small>
                    <h3 class="fw-bold">
                        Rp {{ number_format($rataPendapatan, 0, ',', '.') }}
                    </h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">

                    <h5 class="fw-semibold mb-3">Akses Laporan</h5>

                    <div class="d-grid gap-3">
                        <a href="{{ route('laporan.harian') }}"
                           class="btn btn-outline-dark btn-lg d-flex justify-content-between">
                            <span>Lihat Laporan Harian</span>
                        </a>

                        <a href="{{ route('laporan.rentang') }}"
                           class="btn btn-outline-dark btn-lg d-flex justify-content-between">
                            <span>Lihat Laporan Rentang Tanggal</span>
                        </a>

                        <a href="{{ route('laporan.okupansi') }}"
                           class="btn btn-outline-dark btn-lg d-flex justify-content-between">
                            <span>Lihat Laporan Okupansi</span>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

@endsection
