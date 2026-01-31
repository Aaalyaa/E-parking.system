@extends('petugas.layout')

@section('content')
    <h3>Transaksi Keluar Parkir</h3>

    <form method="POST" id="formKeluar" data-action="{{ route('transaksi.keluar', ':id') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Pilih Kendaraan</label>
            <select class="form-select" id="transaksi_id">
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

        <div id="detailTransaksi" style="display:none">
            <p><strong>Plat:</strong> <span id="plat"></span></p>
            <p><strong>Area:</strong> <span id="area"></span></p>
            <p><strong>Waktu Masuk:</strong> <span id="masuk"></span></p>

            <div class="mb-3">
                <label class="form-label">Metode Pembayaran</label>
                <select name="metode_bayar" class="form-select" required>
                    <option value="">-- Pilih Metode --</option>
                    <option value="TUNAI">Tunai</option>
                    <option value="DEBIT">Debit</option>
                    <option value="E-WALLET">E-Wallet</option>
                </select>
            </div>

            <button type="submit" class="btn btn-danger mt-2">
                Proses Keluar
            </button>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        const select = document.getElementById('transaksi_id');
        const form = document.getElementById('formKeluar');

        select.addEventListener('change', function() {
            const opt = this.options[this.selectedIndex];

            if (!this.value) return;

            document.getElementById('detailTransaksi').style.display = 'block';

            document.getElementById('plat').innerText = opt.dataset.plat;
            document.getElementById('area').innerText = opt.dataset.area;
            document.getElementById('masuk').innerText = opt.dataset.masuk;

            const baseAction = form.dataset.action;
            form.action = baseAction.replace(':id', this.value);
        });
    </script>
@endpush
