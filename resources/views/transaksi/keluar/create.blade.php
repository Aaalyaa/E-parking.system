@extends(auth()->user()->layout())

@section('content')
    <h4 class="fw-bold mb-4">Transaksi Keluar Parkir</h4>

    @if ($transaksi)
        <form method="POST" id="formKeluar" action="{{ route('transaksi.keluar', $transaksi->id) }}">
        @else
            <form>
    @endif
    @csrf

    <div class="mb-3">
        <label class="form-label">Pilih Kendaraan</label>
        <select class="form-select select2" id="transaksi_id" data-placeholder="Pilih Kendaraan Parkir">
            <option value="">-- Pilih Kendaraan Parkir --</option>
            @foreach ($parkirAktif as $aktif)
                <option value="{{ $aktif->id }}" data-plat="{{ $aktif->dataKendaraan->plat_nomor }}"
                    data-tipe="{{ $aktif->dataKendaraan->tipe_kendaraan->nama_tipe }}"
                    data-lokasi="{{ $aktif->area->lokasiArea->lokasi_area }}" data-area="{{ $aktif->area->nama_area }}"
                    data-masuk="{{ $aktif->waktu_masuk->toIso8601String() }}">
                    {{ $aktif->dataKendaraan->plat_nomor }} - {{ $aktif->area->nama_area }}
                </option>
            @endforeach
        </select>
    </div>

    @if ($transaksi && $detailTarif)
        <div class="border rounded p-3 mb-3">
            <p>
                <strong>Plat:</strong>
                {{ $transaksi->dataKendaraan->plat_nomor }}
                - {{ $transaksi->dataKendaraan->tipe_kendaraan->nama_tipe }}
            </p>

            <p>
                <strong>Lokasi & Area:</strong>
                {{ $transaksi->area->lokasiArea->lokasi_area }}
                - {{ $transaksi->area->nama_area }}
            </p>

            <p>
                <strong>Waktu Masuk:</strong>
                {{ $transaksi->waktu_masuk->format('d M Y H:i') }}
            </p>

            <p>
                <strong>Durasi:</strong>
                {{ $detailTarif['durasi_jam'] }} jam
                (± {{ $transaksi->waktu_masuk->diffInMinutes(now()) }} menit)
            </p>

            <hr>

            <p>
                <strong>Tarif Dasar:</strong>
                Rp {{ number_format($detailTarif['tarif_dasar'], 0, ',', '.') }}
            </p>

            <p>
                <strong>Diskon:</strong>
                Rp {{ number_format($detailTarif['diskon'], 0, ',', '.') }}
            </p>

            <p class="fw-bold">
                <strong>Total Bayar:</strong>
                Rp {{ number_format($detailTarif['total'], 0, ',', '.') }}
            </p>

            <div class="mb-3 mt-3">
                <label class="form-label">Metode Pembayaran</label>
                <select name="metode_bayar" class="form-select" required>
                    <option value="">-- Pilih Metode --</option>
                    <option value="TUNAI">Tunai</option>
                    <option value="DEBIT">Debit</option>
                    <option value="E-WALLET">E-Wallet</option>
                </select>
            </div>
        </div>
    @endif

    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-danger" {{ $detailTarif ? '' : 'disabled' }}>
            Proses Transaksi Keluar
        </button>


        <a href="{{ route('tracking.index') }}" class="btn btn-dark">
            Lihat Tracking Kendaraan
        </a>

        <a href="{{ route('transaksi.index') }}" class="btn btn-outline-dark">
            Lihat Histori Transaksi
        </a>
    </div>
    </form>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#transaksi_id').select2({
                theme: 'bootstrap-5',
                placeholder: $('#transaksi_id').data('placeholder'),
                allowClear: true,
                width: '100%'
            });

            $('#transaksi_id').on('change', function() {
                const id = $(this).val();
                if (!id) return;

                window.location.href = `{{ route('transaksi.keluar.create') }}?id=${id}`;
            });
        });
    </script>
@endpush
