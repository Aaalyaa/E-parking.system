<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use App\Models\TransaksiParkir;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Helpers\LogAktivitas;

class LaporanRentangController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->filled(['tanggal_mulai', 'tanggal_akhir'])) {
            return view('laporan.rentang.index');
        }
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        $mulai = Carbon::parse($request->tanggal_mulai)->startOfDay();
        $akhir = Carbon::parse($request->tanggal_akhir)->endOfDay();

        $query = TransaksiParkir::with([
            'tipe_kendaraan',
            'dataKendaraan.member',
            'area'
        ])->whereBetween('waktu_keluar', [$mulai, $akhir])
            ->where('status_parkir', TransaksiParkir::STATUS_OUT);


        $totalTransaksi = (clone $query)->count();

        $totalPendapatan = (clone $query)->sum('total_biaya');

        $kendaraan = (clone $query)
            ->join('tipe_kendaraan', 'transaksi_parkir.id_tipe_kendaraan', '=', 'tipe_kendaraan.id')
            ->select(
                'tipe_kendaraan.nama_tipe',
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('tipe_kendaraan.nama_tipe')
            ->get();

        $metodeBayar = (clone $query)
            ->select(
                'metode_bayar',
                DB::raw('COUNT(*) as total'),
                DB::raw('SUM(total_biaya) as nominal')
            )
            ->groupBy('metode_bayar')
            ->get();

        $transaksi = TransaksiParkir::with(['dataKendaraan.tipe_kendaraan', 'area'])
            ->whereBetween('waktu_keluar', [$mulai, $akhir])
            ->where('status_parkir', TransaksiParkir::STATUS_OUT)
            ->orderBy('waktu_keluar', 'asc')
            ->get();

        return view('laporan.rentang.index', compact(
            'mulai',
            'akhir',
            'totalTransaksi',
            'totalPendapatan',
            'kendaraan',
            'metodeBayar',
            'transaksi'
        ));
    }

    public function rentangPdf(Request $request)
    {
        $mulai = Carbon::parse($request->tanggal_mulai)->startOfDay();
        $akhir = Carbon::parse($request->tanggal_akhir)->endOfDay();

        $transaksi = TransaksiParkir::with(['tipe_kendaraan', 'area'])
            ->whereBetween('waktu_keluar', [$mulai, $akhir])
            ->where('status_parkir', TransaksiParkir::STATUS_OUT)
            ->get();

        $totalTransaksi = $transaksi->count();
        $totalPendapatan = $transaksi->sum('total_biaya');

        $pdf = Pdf::loadView('laporan.rentang.rentang_pdf', compact(
            'mulai',
            'akhir',
            'transaksi',
            'totalTransaksi',
            'totalPendapatan'
        ))->setPaper('A4', 'landscape');

        LogAktivitas::add(
            'EXPORT_LAPORAN_RENTANG',
            'Mengekspor laporan rentang ke PDF untuk periode: ' . $mulai->format('Y-m-d') . ' s/d ' . $akhir->format('Y-m-d'),
            'laporan_rentang',
            null
        );

        return $pdf->download('laporan-rentang-' . now()->format('d-m-Y_H-i') . '.pdf');
    }
}
