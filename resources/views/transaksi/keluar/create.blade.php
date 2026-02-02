@extends(auth()->user()->layout())

@section('content')
    <h4 class="fw-bold mb-4">Transaksi Keluar Parkir</h4>

    <form method="POST" id="formKeluar" data-action="{{ route('transaksi.keluar', ':id') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Pilih Kendaraan</label>
            <select class="form-select select2" id="transaksi_id" data-placeholder="Pilih Kendaraan Parkir">
                <option value="">-- Pilih Kendaraan Parkir --</option>
                @foreach ($parkirAktif as $aktif)
                    <option value="{{ $aktif->id }}" data-plat="{{ $aktif->dataKendaraan->plat_nomor }}"
                        data-masuk="{{ $aktif->waktu_masuk->format('d-m-Y H:i') }}"
                        data-area="{{ $aktif->area->nama_area }}">
                        {{ $aktif->dataKendaraan->plat_nomor }} - {{ $aktif->area->nama_area }}
                    </option>
                @endforeach
            </select>
        </div>

        <div id="detailTransaksi" class="border rounded p-3 mb-3" style="display:none">
            <p><strong>Plat:</strong> <span id="plat"></span></p>
            <p><strong>Area:</strong> <span id="area"></span></p>
            <p><strong>Waktu Masuk:</strong> <span id="masuk"></span></p>

            <div class="mb-3">
                <label class="form-label">Metode Pembayaran</label>
                <select name="metode_bayar" class="form-select">
                    <option value="">-- Pilih Metode --</option>
                    <option value="TUNAI">Tunai</option>
                    <option value="DEBIT">Debit</option>
                    <option value="E-WALLET">E-Wallet</option>
                </select>
            </div>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" id="btnKeluar" class="btn btn-danger" disabled>
                Proses Keluar
            </button>

            <a href="{{ route('tracking.index') }}" class="btn btn-dark">
                Lihat Tracking Kendaraan
            </a>

            <a href="{{ route('tracking.index') }}" class="btn btn-outline-dark">
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
                const value = $(this).val();

                if (!value) {
                    $('#detailTransaksi').hide();
                    $('#btnKeluar').prop('disabled', true);
                    return;
                }

                const opt = this.options[this.selectedIndex];

                $('#detailTransaksi').show();
                $('#btnKeluar').prop('disabled', false);

                $('#plat').text(opt.dataset.plat);
                $('#area').text(opt.dataset.area);
                $('#masuk').text(opt.dataset.masuk);

                $('#formKeluar').attr(
                    'action',
                    $('#formKeluar').data('action').replace(':id', value)
                );
            });
        });
    </script>
@endpush
