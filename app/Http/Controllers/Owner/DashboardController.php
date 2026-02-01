<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\TransaksiParkir;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        $query = TransaksiParkir::whereDate('waktu_keluar', $today)
            ->where('status_parkir', TransaksiParkir::STATUS_OUT);

        $totalTransaksi = $query->count();
        $totalPendapatan = $query->sum('total_biaya');

        $rataPendapatan = $totalTransaksi > 0
            ? $totalPendapatan / $totalTransaksi
            : 0;

        return view('owner.dashboard', compact(
            'totalTransaksi',
            'totalPendapatan',
            'rataPendapatan'
        ));
    }
}
