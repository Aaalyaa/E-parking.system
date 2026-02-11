<aside id="sidebar" class="sidebar sidebar-custom">
    <div class="p-3 h-100">
        <ul class="nav nav-pills flex-column gap-1">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('petugas.dashboard') ? 'active' : '' }}"
                    href="{{ route('petugas.dashboard') }}">Dashboard</a>
            </li>

            <li class="mt-3 fw-bold text-muted">MASTER</li>
            <li><a class="nav-link {{ request()->routeIs('area-kapasitas.*') ? 'active' : '' }}"
                    href="{{ route('area-kapasitas.index') }}">Kapasitas</a></li>
            <li><a class="nav-link {{ request()->routeIs('tarif.*') ? 'active' : '' }}"
                    href="{{ route('tarif.index') }}">Tipe Tarif</a></li>

            <li class="mt-3 fw-bold text-muted">TRANSAKSI</li>
            <li><a class="nav-link {{ request()->routeIs('transaksi.*') ? 'active' : '' }}"
                    href="{{ route('transaksi.index') }}">Transaksi Parkir</a></li>

            <li class="mt-3 fw-bold text-muted small">KENDARAAN & MEMBER</li>
            <li><a class="nav-link {{ request()->routeIs('membership.*') ? 'active' : '' }}"
                    href="{{ route('membership.index') }}">Membership</a></li>
            <li><a class="nav-link {{ request()->routeIs('data-kendaraan.*') ? 'active' : '' }}"
                    href="{{ route(name: 'data-kendaraan.index') }}">Data Kendaraan</a></li>
            <li><a class="nav-link {{ request()->routeIs('tracking.*') ? 'active' : '' }}"
                    href="{{ route('tracking.index') }}">Tracking Kendaraan</a></li>
        </ul>
</aside>
