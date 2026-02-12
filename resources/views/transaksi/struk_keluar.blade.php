@extends(auth()->user()->layout())

@section('content')
<style>
        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            #print-area {
                margin: 0;
                display: block;
            }
        }
    </style>
<div class="mt-5 d-flex justify-content-center">

    <div class="position-relative d-flex align-items-center">

        <div id="print-area"
            style="
                width: 300px;
                font-family: monospace;
                border: 1px dashed #000;
                padding: 12px;
                background: #fff;
            ">
<pre style="margin:0; white-space: pre-wrap;">
==============================
      STRUK KELUAR PARKIR
==============================

Plat        : {{ $transaksi->plat_nomor }}
Area        : {{ $transaksi->area->nama_area }}
Tipe        : {{ $transaksi->tipe_kendaraan->nama_tipe }}

Jam Masuk   : {{ $transaksi->waktu_masuk->format('H:i') }}
Jam Keluar  : {{ $transaksi->waktu_keluar->format('H:i') }}
Durasi      : {{ $transaksi->durasi_format }}

Tarif Dasar : Rp {{ number_format($transaksi->tarif->tarif_per_jam, 0, ',', '.') }}
@if ($transaksi->diskon_nominal > 0)
Diskon      : Rp {{ number_format($transaksi->diskon_nominal, 0, ',', '.') }}
@endif

Bayar       : Rp {{ number_format($transaksi->bayar, 0, ',', '.') }}
Kembali     : Rp {{ number_format($transaksi->kembali, 0, ',', '.') }}

------------------------------
TOTAL BAYAR : Rp {{ number_format($transaksi->total_biaya, 0, ',', '.') }}
------------------------------

Metode      : {{ $transaksi->metode_bayar }}

Tanggal     : {{ $transaksi->waktu_keluar->format('d-m-Y') }}
Operator    : {{ auth()->user()->username }}
</pre>
        </div>

        <div class="d-flex flex-column gap-3 ms-4 no-print">
            <button onclick="printStruk()" class="btn btn-primary">
                Cetak Struk
            </button>

            <a href="{{ route('transaksi.index') }}" class="btn btn-success">
                Lihat Histori
            </a>
        </div>

    </div>
</div>
@endsection
@push('scripts')
    <script>
        let sudahLog = false;

        function printStruk() {
            const printContent = document.getElementById('print-area').innerHTML;
            const originalContent = document.body.innerHTML;

            if (!sudahLog) {
                fetch("{{ route('transaksi.log_cetak', $transaksi->id) }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json"
                    }
                });
                sudahLog = true;
            }

            document.body.innerHTML = printContent;
            window.print();
            document.body.innerHTML = originalContent;
        }
    </script>
@endpush
