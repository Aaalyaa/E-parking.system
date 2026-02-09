<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use App\Models\TransaksiParkir;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanHarianController extends Controller
{
    public function index(Request $request)
    {
        $tanggal = $request->tanggal
            ? Carbon::parse($request->tanggal)
            : Carbon::today();

        $baseQuery = TransaksiParkir::whereDate('waktu_keluar', $tanggal)
            ->where('status_parkir', TransaksiParkir::STATUS_OUT);

        $totalTransaksi = (clone $baseQuery)->count();
        $totalPendapatan = (clone $baseQuery)->sum('total_biaya');

        $kendaraan = TransaksiParkir::join(
            'data_kendaraan',
            'transaksi_parkir.id_data_kendaraan',
            '=',
            'data_kendaraan.id'
        )
            ->join(
                'tipe_kendaraan',
                'data_kendaraan.id_tipe_kendaraan',
                '=',
                'tipe_kendaraan.id'
            )
            ->whereDate('transaksi_parkir.waktu_keluar', $tanggal)
            ->where('transaksi_parkir.status_parkir', TransaksiParkir::STATUS_OUT)
            ->select(
                'tipe_kendaraan.nama_tipe',
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('tipe_kendaraan.nama_tipe')
            ->get();

        $metodeBayar = (clone $baseQuery)
            ->select(
                'metode_bayar',
                DB::raw('COUNT(*) as total'),
                DB::raw('SUM(total_biaya) as nominal')
            )
            ->groupBy('metode_bayar')
            ->get();

        return view('laporan.harian.index', compact(
            'tanggal',
            'totalTransaksi',
            'totalPendapatan',
            'kendaraan',
            'metodeBayar'
        ));
    }

    public function harianPdf(Request $request)
    {
        $tanggal = $request->tanggal
            ? Carbon::parse($request->tanggal)
            : Carbon::today();

        $query = TransaksiParkir::whereDate('waktu_keluar', $tanggal)
            ->where('status_parkir', TransaksiParkir::STATUS_OUT);

        $totalTransaksi = $query->count();
        $totalPendapatan = $query->sum('total_biaya');

        $kendaraan = TransaksiParkir::join(
            'data_kendaraan',
            'transaksi_parkir.id_data_kendaraan',
            '=',
            'data_kendaraan.id'
        )
            ->join(
                'tipe_kendaraan',
                'data_kendaraan.id_tipe_kendaraan',
                '=',
                'tipe_kendaraan.id'
            )
            ->whereDate('transaksi_parkir.waktu_keluar', $tanggal)
            ->where('transaksi_parkir.status_parkir', TransaksiParkir::STATUS_OUT)
            ->select(
                'tipe_kendaraan.nama_tipe',
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('tipe_kendaraan.nama_tipe')
            ->get();

        $metodeBayar = TransaksiParkir::whereDate('waktu_keluar', $tanggal)
            ->where('status_parkir', TransaksiParkir::STATUS_OUT)
            ->select(
                'metode_bayar',
                DB::raw('COUNT(*) as total'),
                DB::raw('SUM(total_biaya) as nominal')
            )
            ->groupBy('metode_bayar')
            ->get();

        $pdf = Pdf::loadView('laporan.harian.harian_pdf', compact(
            'tanggal',
            'totalTransaksi',
            'totalPendapatan',
            'kendaraan',
            'metodeBayar'
        ))->setPaper('A4', 'landscape');

        return $pdf->download(
            'laporan-harian-' . now()->format('d-m-Y H-i') . '.pdf'
        );
    }
}
