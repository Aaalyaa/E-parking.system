<aside class="sidebar bg-white border-end" style="width: 240px; min-height: 100%; overflow-y: auto;">
    <div class="p-3">
        <ul class="nav nav-pills flex-column gap-1">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('petugas.dashboard') }}">Dashboard</a>
            </li>

                <li class="mt-3 fw-bold text-muted small">TRANSAKSI</li>
                    <li><a class="nav-link" href="{{ route('transaksi.index') }}">Transaksi Parkir</a></li>

                <li class="mt-3 fw-bold text-muted small">MASTER</li>
                    <li><a class="nav-link" href="{{ route('area-kapasitas.index') }}">Kapasitas</a></li>
                
                    <li class="mt-3 fw-bold text-muted small">KENDARAAN</li>
                    <li><a class="nav-link" href="{{ route('tracking.index') }}">Tracking Kendaraan</a></li>
        </ul>
</aside>
