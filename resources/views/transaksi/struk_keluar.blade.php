@extends(auth()->user()->layout())

@section('content')
    <div class="d-flex justify-content-center mt-5">
        <div class="d-flex align-items-center gap-5">

            <div id="print-area"
                style="
            width: 350px;
            font-family: monospace;
            border: 1px dashed #000;
            padding: 12px;
            margin: auto;
            background: #fff;
        ">
                <pre style="margin:0; white-space: pre-wrap;">
==============================
      STRUK KELUAR PARKIR
==============================

Plat        : {{ $transaksi->dataKendaraan->plat_nomor }}
Area        : {{ $transaksi->area->nama_area }}
Tipe        : {{ $transaksi->dataKendaraan->tipe_kendaraan->nama_tipe }}

Jam Masuk   : {{ $transaksi->waktu_masuk->format('H:i') }}
Jam Keluar  : {{ $transaksi->waktu_keluar->format('H:i') }}
Durasi      : {{ $transaksi->durasi_format }}

Tarif Dasar : Rp {{ number_format($transaksi->tarif->harga, 0, ',', '.') }}
@if ($transaksi->diskon_nominal > 0)
Diskon      : - Rp {{ number_format($transaksi->diskon_nominal, 0, ',', '.') }}
@endif

------------------------------
TOTAL BAYAR :
Rp {{ number_format($transaksi->total_biaya, 0, ',', '.') }}
------------------------------

Metode      : {{ $transaksi->metode_bayar }}

Tanggal     : {{ $transaksi->waktu_keluar->format('d-m-Y') }}
Operator    : {{ auth()->user()->username }}
</pre>
            </div>

            <div class="d-flex flex-column justify-content-center gap-4 no-print">
                <button onclick="printStruk()" class="btn btn-primary">
                    Cetak Struk
                </button>

                <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">
                    Kembali
                </a>
            </div>

        </div>
    </div>
@endsection
@push('scripts')
    <script>
        function printStruk() {
            const printContent = document.getElementById('print-area').innerHTML;
            const originalContent = document.body.innerHTML;

            document.body.innerHTML = printContent;
            window.print();
            document.body.innerHTML = originalContent;

            location.reload();
        }
    </script>
@endpush
