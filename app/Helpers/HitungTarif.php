<?php

namespace App\Helpers;

use App\Models\Tarif;

class HitungTarif
{
    public static function from($transaksi, $waktuKeluar = null)
    {
        $waktuKeluar = $waktuKeluar ?? now();

        $durasiMenit = $transaksi->waktu_masuk->diffInMinutes($waktuKeluar);
        $durasiJam   = ceil($durasiMenit / 60);

        $tarif = Tarif::where('id_tipe_kendaraan', $transaksi->dataKendaraan->id_tipe_kendaraan)
            ->where('durasi_minimal', '<=', $durasiJam)
            ->where('durasi_maksimal', '>=', $durasiJam)
            ->first();

        if (!$tarif) {
            return null;
        }

        $total = $tarif->harga;
        $diskonNominal = 0;
        $diskonPersen = 0;

        $member = $transaksi->dataKendaraan->memberAktif;
        if ($member && $member->tipe_member) {
            $diskonPersen = $member->tipe_member->diskon_persen;
            $diskonNominal = ($diskonPersen / 100) * $total;
        }

        $bayarAkhir = max(0, $total - $diskonNominal);

        return [
            'id_tarif'      => $tarif->id,
            'durasi_jam'    => $durasiJam,
            'tarif_dasar'   => $total,
            'diskon_persen' => $diskonPersen,
            'diskon'        => $diskonNominal,
            'total'         => $bayarAkhir,
        ];
    }
}
