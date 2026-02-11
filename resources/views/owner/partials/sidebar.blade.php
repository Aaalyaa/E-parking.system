<aside id="sidebar" class="sidebar sidebar-custom">
    <div class="p-3 h-100">
        <ul class="nav nav-pills flex-column gap-1">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('owner.dashboard') ? 'active' : '' }}"
                    href="{{ route('owner.dashboard') }}">Dashboard</a>
            </li>

            <li class="mt-3 fw-bold text-muted small">MASTER</li>
            <li><a class="nav-link {{ request()->routeIs('area-kapasitas.*') ? 'active' : '' }}"
                    href="{{ route('area-kapasitas.index') }}">Kapasitas</a></li>
            <li><a class="nav-link {{ request()->routeIs('tarif.*') ? 'active' : '' }}"
                    href="{{ route('tarif.index') }}">Tipe Tarif</a></li>

            <li class="mt-3 fw-bold text-muted small">TRANSAKSI</li>
            <li><a class="nav-link {{ request()->routeIs('transaksi.*') ? 'active' : '' }}"
                    href="{{ route('transaksi.index') }}">Transaksi Parkir</a></li>

            <li class="mt-3 fw-bold text-muted small">KENDARAAN & MEMBER</li>
            <li><a class="nav-link {{ request()->routeIs('membership.*') ? 'active' : '' }}"
                    href="{{ route('membership.index') }}">Membership</a></li>
            <li><a class="nav-link {{ request()->routeIs('data-kendaraan.*') ? 'active' : '' }}"
                    href="{{ route(name: 'data-kendaraan.index') }}">Data Kendaraan</a></li>

            <li class="mt-3 fw-bold text-muted small">LAPORAN</li>
            <li><a class="nav-link {{ request()->routeIs('laporan.harian') ? 'active' : '' }}"
                    href="{{ route('laporan.harian') }}">Laporan Harian</a></li>
            <li><a class="nav-link {{ request()->routeIs('laporan.rentang') ? 'active' : '' }}"
                    href="{{ route('laporan.rentang') }}">Laporan Rentang</a></li>
            <li><a class="nav-link {{ request()->routeIs('laporan.tipe-kendaraan') ? 'active' : '' }}"
                    href="{{ route('laporan.tipe-kendaraan') }}">Laporan Tipe Kendaraan</a></li>
            <li><a class="nav-link {{ request()->routeIs('laporan.okupansi') ? 'active' : '' }}"
                    href="{{ route('laporan.okupansi') }}">Laporan Okupansi</a></li>
        </ul>
    </div>
</aside>
