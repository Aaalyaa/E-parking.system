@extends(auth()->user()->layout())

@section('content')
    <h4 class="fw-bold mb-4">Transaksi Keluar Parkir</h4>

    <form method="GET" action="{{ route('transaksi.keluar.create') }}">
        <div class="row align-items-end mb-3">
            <div class="col-md-9">
                <label class="form-label">Kode Struk Masuk</label>
                <select name="kode" class="form-select select2" required>
                    <option value="">-- Pilih Kode Struk --</option>
                    @foreach ($listStruk as $item)
                        <option value="{{ $item->kode }}" {{ request('kode') == $item->kode ? 'selected' : '' }}>
                            {{ $item->kode }} | {{ $item->plat_nomor }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3 d-grid">
                <button class="btn btn-primary">
                    Cari Transaksi
                </button>
            </div>
        </div>
    </form>

    @if ($transaksi && $detailTarif)
        <form method="POST" action="{{ route('transaksi.keluar', $transaksi->id) }}">
            @csrf
            <div class="border rounded p-3 mb-3 mt-3">
                <p>
                    <strong>Plat:</strong>
                    {{ $transaksi->plat_nomor }}
                    - {{ $transaksi->tipe_kendaraan->nama_tipe }}
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

                <p>
                    <strong>Membership:</strong>
                    @if ($transaksi->dataKendaraan?->member && $transaksi->dataKendaraan->member->is_aktif)
                        <span class="badge bg-success">
                            Aktif - {{ $transaksi->dataKendaraan->member->tipe_member->tipe_member }}
                        </span>
                    @else
                        <span class="badge bg-secondary">Non-member</span>
                    @endif
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

                <div class="mb-3 mt-3" id="bayarField" style="display:none;">
                    <label class="form-label">Jumlah Bayar (Tunai)</label>
                    <input type="number" name="bayar" id="bayarInput" class="form-control"
                        placeholder="Masukkan uang bayar">

                    <small class="text-danger d-none" id="errorBayar">
                        Uang yang dibayar kurang.
                    </small>

                    <div class="mt-3">
                        <label class="form-label">Kembalian</label>
                        <input type="text" id="kembalianInput" class="form-control" readonly value="0">
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success" {{ $detailTarif ? '' : 'disabled' }}>
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
    @endif
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                theme: 'bootstrap-5',
                placeholder: 'Pilih kode struk',
                allowClear: true,
                width: '100%'
            });

            const metodeSelect = document.querySelector('select[name="metode_bayar"]');
            const bayarField = document.getElementById('bayarField');
            const bayarInput = document.getElementById('bayarInput');
            const errorBayar = document.getElementById('errorBayar');
            const kembalianInput = document.getElementById('kembalianInput');

            const totalBayar = {{ $detailTarif['total'] ?? 0 }};

            metodeSelect.addEventListener('change', function() {
                if (this.value === 'TUNAI') {
                    bayarField.style.display = 'block';
                } else {
                    bayarField.style.display = 'none';
                    bayarInput.value = '';
                    errorBayar.classList.add('d-none');
                    kembalianBox.classList.add('d-none');
                }
            });

            bayarInput.addEventListener('input', function() {
                let bayar = parseInt(this.value) || 0;

                if (bayar < totalBayar) {
                    errorBayar.classList.remove('d-none');
                    kembalianInput.value = "0";
                } else {
                    errorBayar.classList.add('d-none');

                    let kembali = bayar - totalBayar;

                    kembalianInput.value = kembali.toLocaleString('id-ID');
                }
            });
        });
    </script>
@endpush
