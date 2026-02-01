<aside class="sidebar bg-white border-end" style="width: 240px; min-height: 100%; overflow-y: auto;">
    <div class="p-3">
        <ul class="nav nav-pills flex-column gap-1">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                    href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>

            <li class="mt-3 fw-bold text-muted">MASTER</li>
            <li><a class="nav-link {{ request()->routeIs('lokasi-area.*') ? 'active' : '' }}"
                    href="{{ route('lokasi-area.index') }}">Lokasi Area</a></li>
            <li><a class="nav-link {{ request()->routeIs('area.*') ? 'active' : '' }}"
                    href="{{ route('area.index') }}">Area</a></li>
            <li><a class="nav-link {{ request()->routeIs('area-kapasitas.*') ? 'active' : '' }}"
                    href="{{ route('area-kapasitas.index') }}">Kapasitas</a></li>
            <li><a class="nav-link {{ request()->routeIs('tipe-kendaraan.*') ? 'active' : '' }}"
                    href="{{ route('tipe-kendaraan.index') }}">Tipe Kendaraan</a></li>
            <li><a class="nav-link {{ request()->routeIs('tipe-member.*') ? 'active' : '' }}"
                    href="{{ route('tipe-member.index') }}">Tipe Member</a></li>
            <li><a class="nav-link {{ request()->routeIs('tarif.*') ? 'active' : '' }}"
                    href="{{ route('tarif.index') }}">Tipe Tarif</a></li>
            <li><a class="nav-link {{ request()->routeIs('data-kendaraan.*') ? 'active' : '' }}"
                    href="{{ route(name: 'data-kendaraan.index') }}">Data Kendaraan</a></li>

            <li class="mt-3 fw-bold text-muted">TRANSAKSI</li>
            <li><a class="nav-link {{ request()->routeIs('transaksi.*') ? 'active' : '' }}"
                    href="{{ route('transaksi.index') }}">Transaksi Parkir</a></li>

            <li class="mt-3 fw-bold text-muted">KENDARAAN & MEMBER</li>
            <li><a class="nav-link {{ request()->routeIs('membership.*') ? 'active' : '' }}" href="{{ route('membership.index') }}">Membership</a></li>
            <li><a class="nav-link {{ request()->routeIs('tracking.*') ? 'active' : '' }}" href="{{ route('tracking.index') }}">Tracking Kendaraan</a></li>

            <li class="mt-3 fw-bold text-muted small">LAPORAN</li>
            <li><a class="nav-link {{ request()->routeIs('laporan.harian') ? 'active' : '' }}" href="{{ route('laporan.harian') }}">Laporan Harian</a></li>
            <li><a class="nav-link {{ request()->routeIs('laporan.rentang') ? 'active' : '' }}" href="{{ route('laporan.rentang') }}">Laporan Rentang</a></li>
            <li><a class="nav-link {{ request()->routeIs('laporan.okupansi') ? 'active' : '' }}" href="{{ route('laporan.okupansi') }}">Laporan Okupansi</a></li>

            <li class="mt-3 fw-bold text-muted small">PENGATURAN PENGGUNA</li>
            <li><a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">Akun Pengguna</a></li>
            <li><a class="nav-link {{ request()->routeIs('log-aktivitas.*') ? 'active' : '' }}" href="{{ route('log-aktivitas.index') }}">Log Aktivitas</a></li>
        </ul>
    </div>
</aside>
