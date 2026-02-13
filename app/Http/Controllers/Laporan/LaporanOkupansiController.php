<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Helpers\LogAktivitas;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanOkupansiController extends Controller
{
    public function index()
    {
        $areas = Area::with([
            'lokasiArea',
            'kapasitasArea.tipeKendaraan',
            'transaksiAktif' => function ($q) {
                $q->whereNull('waktu_keluar');
            }
        ])->get();

        return view('laporan.okupansi.index', [
            'areas' => $areas,
            'waktu' => now(),
        ]);
    }

    public function okupansiPdf()
    {
        $areas = Area::with([
            'lokasiArea',
            'kapasitasArea.tipeKendaraan',
            'transaksiAktif' => function ($q) {
                $q->whereNull('waktu_keluar');
            }
        ])->get();

        $data = [];

        foreach ($areas as $area) {
            foreach ($area->kapasitasArea as $kapasitas) {

                $terpakai = $area->transaksiAktif
                    ->where('id_tipe_kendaraan', $kapasitas->id_tipe_kendaraan)
                    ->count();

                $tersedia = max(0, $kapasitas->kapasitas - $terpakai);

                $persen = $kapasitas->kapasitas > 0
                    ? round(($terpakai / $kapasitas->kapasitas) * 100, 1)
                    : 0;

                $data[] = [
                    'lokasi'     => $area->lokasiArea->lokasi_area,
                    'area'       => $area->nama_area,
                    'tipe'       => $kapasitas->tipeKendaraan->nama_tipe,
                    'kapasitas'  => $kapasitas->kapasitas,
                    'terpakai'   => $terpakai,
                    'tersedia'   => $tersedia,
                    'persen'     => $persen,
                ];
            }
        }

        $pdf = Pdf::loadView('laporan.okupansi.okupansi_pdf', [
            'data'  => $data,
            'waktu' => now(),
        ])->setPaper('A4', 'landscape');

        LogAktivitas::add(
            'EXPORT_LAPORAN_OKUPANSI',
            'Mengekspor laporan okupansi ke PDF',
            'laporan_okupansi',
            null
        );

        return $pdf->download(
            'laporan-okupansi-' . now()->format('d-m-Y_H-i') . '.pdf'
        );
    }
}
