<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use App\Models\TransaksiParkir;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

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

        $query = TransaksiParkir::whereBetween('waktu_keluar', [$mulai, $akhir])
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
            ->whereBetween('transaksi_parkir.waktu_keluar', [$mulai, $akhir])
            ->where('transaksi_parkir.status_parkir', TransaksiParkir::STATUS_OUT)
            ->select(
                'tipe_kendaraan.nama_tipe',
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('tipe_kendaraan.nama_tipe')
            ->get();

        $metodeBayar = TransaksiParkir::whereBetween('waktu_keluar', [$mulai, $akhir])
            ->where('status_parkir', TransaksiParkir::STATUS_OUT)
            ->select(
                'metode_bayar',
                DB::raw('COUNT(*) as total'),
                DB::raw('SUM(total_biaya) as nominal')
            )
            ->groupBy('metode_bayar')
            ->get();

        return view('laporan.rentang.index', compact(
            'mulai',
            'akhir',
            'totalTransaksi',
            'totalPendapatan',
            'kendaraan',
            'metodeBayar'
        ));
    }
}
