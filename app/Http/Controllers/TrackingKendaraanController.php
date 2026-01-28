<?php

namespace App\Http\Controllers;

use App\Models\DataKendaraan;
use App\Models\Area;
use App\Models\TransaksiParkir;
use Illuminate\Http\Request;

class TrackingKendaraanController extends Controller
{
    public function index()
    {
        $dataKendaraan = DataKendaraan::with('tipe_kendaraan')->get();
        $areas = Area::with('lokasiArea')->get();
        $parkirAktif = TransaksiParkir::where('status_parkir', TransaksiParkir::STATUS_IN)->get();

        return view('tracking.index', compact('dataKendaraan', 'areas', 'parkirAktif'));
    } 
}
