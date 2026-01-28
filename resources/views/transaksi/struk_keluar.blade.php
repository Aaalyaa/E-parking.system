@extends(auth()->user()->layout())

@section('content')
<div style="
    width: 350px;
    font-family: monospace;
    border: 1px dashed #000;
    padding: 12px;
    margin: auto;
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
Diskon      : Rp {{ number_format($transaksi->diskon_nominal, 0, ',', '.') }}
@endif

------------------------------
TOTAL BAYAR :
Rp {{ number_format($transaksi->total_biaya, 0, ',', '.') }}
------------------------------

Metode      : {{ $transaksi->metode_bayar }}

Terima Kasih!
Tanggal     : {{ $transaksi->waktu_keluar->format('d-m-Y') }}
Operator    : {{ auth()->user()->username }}
</pre>

</div>
@endsection