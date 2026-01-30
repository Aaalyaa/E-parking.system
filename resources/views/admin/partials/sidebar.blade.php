<aside class="sidebar bg-white border-end" style="width: 240px; min-height: 100%; overflow-y: auto;">
    <div class="p-3">
        <ul class="nav nav-pills flex-column gap-1">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>

                <li class="mt-3 fw-bold text-muted small">MASTER</li>
                    <li><a class="nav-link" href="{{ route('lokasi-area.index') }}">Lokasi Area</a></li>
                    <li><a class="nav-link" href="{{ route('area.index') }}">Area</a></li>
                    <li><a class="nav-link" href="{{ route('area-kapasitas.index') }}">Kapasitas</a></li>
                    <li><a class="nav-link" href="{{ route('tipe-kendaraan.index') }}">Tipe Kendaraan</a></li>
                    <li><a class="nav-link" href="{{ route('tipe-member.index') }}">Tipe Member</a></li>
                    <li><a class="nav-link" href="{{ route('tarif.index') }}">Tipe Tarif</a></li>
                    <li><a class="nav-link" href="{{ route(name: 'data-kendaraan.index') }}">Data Kendaraan</a></li>

                <li class="mt-3 fw-bold text-muted small">TRANSAKSI</li>
                    <li><a class="nav-link" href="{{ route('transaksi.index') }}">Transaksi Parkir</a></li>

                <li class="mt-3 fw-bold text-muted small">KENDARAAN & MEMBER</li>
                    <li><a class="nav-link" href="{{ route('membership.index') }}">Membership</a></li>
                    <li><a class="nav-link" href="{{ route('tracking.index') }}">Tracking Kendaraan</a></li>

                <li class="mt-3 fw-bold text-muted small">LAPORAN</li>
                    <li><a class="nav-link" href="{{ route('laporan.harian') }}">Laporan Harian</a></li>
                    <li><a class="nav-link" href="{{ route('laporan.rentang') }}">Laporan Rentang</a></li>
                    <li><a class="nav-link" href="{{ route('laporan.okupansi') }}">Laporan Okupansi</a></li>

                <li class="mt-3 fw-bold text-muted small">PENGATURAN PENGGUNA</li>
                    <li><a class="nav-link" href="{{ route('users.index') }}">Akun Pengguna</a></li>
                    <li><a class="nav-link" href="{{ route('log-aktivitas.index') }}">Log Aktivitas</a></li>
        </ul>
    </div>
</aside>
