<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use App\Models\TransaksiParkir;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanTipeKendaraanController extends Controller
{
    public function index(Request $request)
    {
        $tanggalAwal  = $request->tanggal_awal;
        $tanggalAkhir = $request->tanggal_akhir;

        $query = TransaksiParkir::where('status_parkir', TransaksiParkir::STATUS_OUT);

        if ($tanggalAwal && $tanggalAkhir) {
            $query->whereBetween('waktu_keluar', [$tanggalAwal, $tanggalAkhir]);
        }

        $laporan = $query
            ->join('tipe_kendaraan', 'transaksi_parkir.id_tipe_kendaraan', '=', 'tipe_kendaraan.id')
            ->select(
                'tipe_kendaraan.nama_tipe',
                DB::raw('COUNT(transaksi_parkir.id) as jumlah'),
                DB::raw('SUM(transaksi_parkir.total_biaya) as total_revenue')
            )
            ->groupBy('tipe_kendaraan.nama_tipe')
            ->get();

        return view('laporan.tipe-kendaraan.index', compact(
            'laporan',
            'tanggalAwal',
            'tanggalAkhir'
        ));
    }

    public function pdf(Request $request)
    {
        $tanggalAwal  = $request->tanggal_awal;
        $tanggalAkhir = $request->tanggal_akhir;

        $query = TransaksiParkir::where('status_parkir', TransaksiParkir::STATUS_OUT);

        if ($tanggalAwal && $tanggalAkhir) {
            $query->whereBetween('waktu_keluar', [$tanggalAwal, $tanggalAkhir]);
        }

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
            'laporan',
            'tanggalAwal',
            'tanggalAkhir'
        ))->setPaper('A4', 'landscape');

        return $pdf->download(
            'laporan-tipe-kendaraan-' . now()->format('d-m-Y') . '.pdf'
        );
    }
}