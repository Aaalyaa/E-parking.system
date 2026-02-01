<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\TransaksiParkir;
use App\Models\KapasitasArea;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
{
    $sedangParkir = TransaksiParkir::where('status_parkir', TransaksiParkir::STATUS_IN)
        ->count();

    $totalKapasitas = KapasitasArea::sum('kapasitas');

    $terisi = TransaksiParkir::where('status_parkir', TransaksiParkir::STATUS_IN)
        ->count();

    $sisaKapasitas = max($totalKapasitas - $terisi, 0);

    $areaPadat = TransaksiParkir::select('id_area', DB::raw('COUNT(*) as total'))
        ->where('status_parkir', TransaksiParkir::STATUS_IN)
        ->groupBy('id_area')
        ->orderByDesc('total')
        ->with('area')
        ->first();

    return view('petugas.dashboard', compact(
        'sedangParkir',
        'sisaKapasitas',
        'areaPadat'
    ));
}
}
