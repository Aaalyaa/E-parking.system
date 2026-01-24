<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Area;
use Illuminate\Http\Request;

class TrackingParkirController extends Controller
{
    public function index()
    {
        $areas = Area::with(['lokasiArea', 'kapasitasArea.tipeKendaraan', 'transaksiAktif'])
        ->get();
        return view('petugas.kendaraan.tracking.index', compact('areas'));
    }
}
