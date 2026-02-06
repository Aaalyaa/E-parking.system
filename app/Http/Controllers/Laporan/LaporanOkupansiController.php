<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use App\Models\Area;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanOkupansiController extends Controller
{
    public function index(Request $request)
    {
        $tanggal = $request->filled('tanggal')
            ? Carbon::parse($request->tanggal)
            : Carbon::today();

        $areas = Area::with([
            'lokasiArea',
            'kapasitasArea.tipeKendaraan',
            'transaksiAktif' => function ($q) use ($tanggal) {
                $q->whereDate('waktu_masuk', '<=', $tanggal)
                    ->whereNull('waktu_keluar');
            }
        ])->get();

        return view('laporan.okupansi.index', compact('tanggal', 'areas'));
    }

    public function okupansiPdf()
    {
        $areas = Area::with(['lokasiArea', 'kapasitasArea.tipeKendaraan', 'transaksiAktif'])
            ->get();

        $data = [];

        foreach ($areas as $area) {
            foreach ($area->kapasitasArea as $kapasitas) {
                $terpakai = $area->transaksiAktif
                    ->where('dataKendaraan.id_tipe_kendaraan', $kapasitas->id_tipe_kendaraan)
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
            'data' => $data,
            'tanggal' => now()
        ])->setPaper('A4', 'landscape');

        return $pdf->download('laporan-okupansi-' . now()->format('d-m-Y') . '.pdf');
    }
}
