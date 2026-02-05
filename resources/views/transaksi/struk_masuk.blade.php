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
      STRUK MASUK PARKIR
==============================

Area       : {{ $transaksi->area->nama_area }}
Jam Masuk  : {{ $transaksi->waktu_masuk->format('H:i') }}
Plat       : {{ $transaksi->plat_nomor }}
Tipe       : {{ $transaksi->tipe_kendaraan->nama_tipe }}

==============================
Nomor Struk:
{{ $transaksi->kode }}

</pre>

                <div class="text-center mt-1">
                    {!! QrCode::size(120)->generate($transaksi->kode) !!}
                </div>

            </div>

            <div class="d-flex flex-column gap-3 ms-4 no-print">
                <button onclick="printStruk()" class="btn btn-primary">
                    Cetak Struk
                </button>

                <a href="{{ route('tracking.index') }}" class="btn btn-success">
                    Lihat Tracking
                </a>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function printStruk() {
            const printArea = document.getElementById('print-area').outerHTML;

            const originalContent = document.body.innerHTML;

            document.body.innerHTML = `
        <div style="display:flex; justify-content:flex-start;">
            ${printArea}
        </div>
    `;

            window.print();
            document.body.innerHTML = originalContent;
        }
    </script>
@endpush
