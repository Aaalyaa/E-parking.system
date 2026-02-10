<?php

namespace App\Helpers;

use App\Models\Tarif;

class HitungTarif
{
    public static function from($transaksi, $waktuKeluar = null)
    {
        $waktuKeluar = $waktuKeluar ?? now();

        $durasiMenit = $transaksi->waktu_masuk->diffInMinutes($waktuKeluar);
        $durasiJam   = max(1, ceil($durasiMenit / 60));

        $tarif = Tarif::where('id_tipe_kendaraan', $transaksi->id_tipe_kendaraan)
            ->first();

        if (!$tarif) {
            return null;
        }

        $tarifDasar = $durasiJam * $tarif->tarif_per_jam;

        $diskonNominal = 0;
        $diskonPersen = 0;

        $member = $transaksi->dataKendaraan?->member;

        if ($member && $member->is_aktif && $member->tipe_member) {
            $diskonPersen = $member->tipe_member->diskon_persen;
            $diskonNominal = ($diskonPersen / 100) * $tarifDasar;
        }

        return [
            'id_tarif'      => $tarif->id,
            'durasi_jam'    => $durasiJam,
            'tarif_dasar'   => $tarifDasar,
            'diskon_persen' => $diskonPersen,
            'diskon'        => $diskonNominal,
            'total'         => max(0, $tarifDasar - $diskonNominal),
        ];
    }
}
