<aside class="sidebar sidebar-custom border-end" style="width: 240px; min-height: 100%; overflow-y: auto;">
    <div class="p-3">
        <ul class="nav nav-pills flex-column gap-1">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('owner.dashboard') ? 'active' : '' }}"
                    href="{{ route('owner.dashboard') }}">Dashboard</a>
            </li>

            <li class="mt-3 fw-bold text-muted small">MASTER</li>
            <li><a class="nav-link {{ request()->routeIs('area-kapasitas.*') ? 'active' : '' }}"
                    href="{{ route('area-kapasitas.index') }}">Kapasitas</a></li>

            <li class="mt-3 fw-bold text-muted small">TRANSAKSI</li>
            <li><a class="nav-link {{ request()->routeIs('transaksi.*') ? 'active' : '' }}"
                    href="{{ route('transaksi.index') }}">Transaksi Parkir</a></li>

            <li class="mt-3 fw-bold text-muted small">LAPORAN</li>
            <li><a class="nav-link {{ request()->routeIs('laporan.harian') ? 'active' : '' }}"
                    href="{{ route('laporan.harian') }}">Laporan Harian</a></li>
            <li><a class="nav-link {{ request()->routeIs('laporan.rentang') ? 'active' : '' }}"
                    href="{{ route('laporan.rentang') }}">Laporan Rentang</a></li>
            <li><a class="nav-link {{ request()->routeIs('laporan.okupansi') ? 'active' : '' }}"
                    href="{{ route('laporan.okupansi') }}">Laporan Okupansi</a></li>
        </ul>
    </div>
</aside>
