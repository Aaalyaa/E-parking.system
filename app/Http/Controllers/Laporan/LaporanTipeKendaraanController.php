<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use App\Models\TransaksiParkir;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\LogAktivitas;

class LaporanTipeKendaraanController extends Controller
{
    public function index(Request $request)
    {
        $query = TransaksiParkir::where('status_parkir', TransaksiParkir::STATUS_OUT);

        $laporan = $query
            ->join('tipe_kendaraan', 'transaksi_parkir.id_tipe_kendaraan', '=', 'tipe_kendaraan.id')
            ->select(
                'tipe_kendaraan.nama_tipe',
                DB::raw('COUNT(transaksi_parkir.id) as jumlah'),
                DB::raw('SUM(transaksi_parkir.total_biaya) as total_revenue')
            )
            ->groupBy('tipe_kendaraan.nama_tipe')
            ->get();

        return view('laporan.tipe-kendaraan.index', compact('laporan'));
    }

    public function pdf(Request $request)
    {
        $query = TransaksiParkir::where('status_parkir', TransaksiParkir::STATUS_OUT);

        $laporan = $query
            ->join('tipe_kendaraan', 'transaksi_parkir.id_tipe_kendaraan', '=', 'tipe_kendaraan.id')
            ->select(
                'tipe_kendaraan.nama_tipe',
                DB::raw('COUNT(transaksi_parkir.id) as jumlah'),
                DB::raw('SUM(transaksi_parkir.total_biaya) as total_revenue')
            )
            ->groupBy('tipe_kendaraan.nama_tipe')
            ->get();

        $pdf = Pdf::loadView('laporan.tipe-kendaraan.tipe_kendaraan_pdf', compact(
            'laporan'
        ))->setPaper('A4', 'landscape');

            LogAktivitas::add(
                'EXPORT_LAPORAN_TIPE_KENDARAAN',
                'Mengekspor laporan tipe kendaraan ke PDF',
                'laporan_tipe_kendaraan',
                null
            );

        return $pdf->download(
            'laporan-tipe-kendaraan-' . now()->format('d-m-Y') . '.pdf'
        );
    }
}
