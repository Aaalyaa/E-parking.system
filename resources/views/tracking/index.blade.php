@extends(auth()->user()->layout())

@section('content')
    <x-page-header title="Kendaraan yang Sedang Parkir" :action-route="$canCreate ? route('transaksi.keluar.create') : null" action-label="Buat Transaksi Keluar" />

    <x-page.filter>
        <form method="GET" class="row g-2" action="{{ route('tracking.index') }}">
            <div class="col-md-6">
                <input type="text" name="plat" value="{{ request('plat') }}" class="form-control"
                    placeholder="Plat Nomor" maxlength="11" pattern="^[A-Z]{1,2} [0-9]{1,4} [A-Z]{1,3}$">
            </div>

            <div class="col-md-3">
                <button class="btn btn-outline-primary w-100">
                    Filter
                </button>
            </div>

            <div class="col-md-3">
                <a href="{{ route('tracking.index') }}" class="btn btn-outline-secondary w-100">
                    Reset
                </a>
            </div>
        </form>
    </x-page.filter>

    <x-table.wrapper>
        <x-table.thead>
            <tr>
                <th>No</th>
                <th>Plat</th>
                <th>Tipe</th>
                <th>Lokasi</th>
                <th>Area</th>
                <th>Waktu Masuk</th>
            </tr>
        </x-table.thead>
        <tbody>
            @forelse ($parkirAktif as $i => $transaksi)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $transaksi->plat_nomor }}</td>
                    <td>{{ $transaksi->tipe_kendaraan->nama_tipe }}</td>
                    <td>{{ $transaksi->area->lokasiArea->lokasi_area }}</td>
                    <td>{{ $transaksi->area->nama_area }}</td>
                    <td>{{ $transaksi->waktu_masuk->format('d-m-Y H:i') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center">
                        Tidak ada kendaraan yang sedang parkir.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </x-table.wrapper>
@endsection
@push("scripts")
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const platInput = document.querySelector("input[name='plat']");

            if (platInput) {
                platInput.addEventListener("input", function(e) {
                    let value = e.target.value.toUpperCase().replace(/[^A-Z0-9]/g, "");

                    let depan = value.substring(0, 2).replace(/[^A-Z]/g, "");
                    let tengah = value.substring(depan.length, depan.length + 4).replace(/[^0-9]/g, "");
                    let belakang = value.substring(depan.length + tengah.length, depan.length + tengah
                        .length + 3).replace(/[^A-Z]/g, "");

                    let formatted = depan;
                    if (tengah) formatted += " " + tengah;
                    if (belakang) formatted += " " + belakang;

                    e.target.value = formatted;
                });
            }
        });
    </script>
@endpush