<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TransaksiParkir;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $tanggal = Carbon::today();

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

        $metodeBayar = $query
            ->select(
                'metode_bayar',
                DB::raw('COUNT(*) as total'),
                DB::raw('SUM(total_biaya) as nominal')
            )
            ->groupBy('metode_bayar')
            ->get();

        return view('admin.laporan.harian.index', compact(
            'tanggal',
            'totalTransaksi',
            'totalPendapatan',
            'kendaraan',
            'metodeBayar'
        ));
    }
}
