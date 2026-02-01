@extends(auth()->user()->layout())

@section('content')
<h4 class="mb-4 fw-bold">Dashboard Admin</h4>

<div class="row g-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <small class="text-muted">Transaksi Hari Ini</small>
                <h3 class="fw-bold mt-2">{{ $totalTransaksiHariIni }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <small class="text-muted">Pendapatan Hari Ini</small>
                <h3 class="fw-bold mt-2">
                    Rp {{ number_format($totalPendapatanHariIni, 0, ',', '.') }}
                </h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <small class="text-muted">Sedang Parkir</small>
                <h3 class="fw-bold mt-2">{{ $kendaraanSedangParkir }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <small class="text-muted">Member Aktif</small>
                <h3 class="fw-bold mt-2">{{ $memberAktif }}</h3>
            </div>
        </div>
    </div>

</div>
@endsection
