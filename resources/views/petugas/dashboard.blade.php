@extends(auth()->user()->layout())

@section('content')
<h4 class="fw-bold mb-4">Dashboard Petugas</h4>

<div class="container-fluid">

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Kendaraan Sedang Parkir</h6>
                    <h3>{{ $sedangParkir }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Sisa Kapasitas</h6>
                    <h3>{{ $sisaKapasitas }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Area Terpadat</h6>
                    <h3>{{ $areaPadat?->area->nama_area ?? '-' }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">

                    <h5 class="mb-4 fw-semibold">Transaksi Cepat</h5>

                    <div class="d-grid gap-3">
                        <a href="{{ route('transaksi.masuk.create') }}"
                           class="btn btn-dark btn-quick-dark btn-lg d-flex justify-content-between align-items-center px-4">
                            <span>Transaksi Masuk</span>
                            <span class="fs-4">→</span>
                        </a>

                        <a href="{{ route('transaksi.keluar.create') }}"
                           class="btn btn-outline-dark btn-lg d-flex justify-content-between align-items-center px-4">
                            <span>Transaksi Keluar</span>
                            <span class="fs-4">←</span>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

@endsection