<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TransaksiParkir;
use App\Models\Member;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $hariIni = Carbon::today();

        $totalTransaksiHariIni = TransaksiParkir::whereDate('waktu_masuk', $hariIni)
            ->count();

        $totalPendapatanHariIni = TransaksiParkir::whereDate('waktu_masuk', $hariIni)
            ->sum('total_biaya');

        $kendaraanSedangParkir = TransaksiParkir::where('status_parkir', TransaksiParkir::STATUS_IN)
            ->count();

        $memberAktif = Member::whereDate('tanggal_kadaluarsa', '>=', $hariIni)
            ->count();

        return view('admin.dashboard', compact(
            'totalTransaksiHariIni',
            'totalPendapatanHariIni',
            'kendaraanSedangParkir',
            'memberAktif'
        ));
    }
}