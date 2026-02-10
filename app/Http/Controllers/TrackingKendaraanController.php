<?php

namespace App\Http\Controllers;

use App\Models\DataKendaraan;
use App\Models\Area;
use App\Models\TransaksiParkir;
use Illuminate\Http\Request;

class TrackingKendaraanController extends Controller
{
    public function index(Request $request)
    {
        $query = TransaksiParkir::with([
            'area.lokasiArea'
        ])->where('status_parkir', TransaksiParkir::STATUS_IN);

        if ($request->filled('plat')) {
            $query->where('plat_nomor', 'like', '%' . $request->plat . '%');
        }

        $parkirAktif = $query->get();

        return view('tracking.index', compact('parkirAktif'), [
            'canCreate' => auth()->user()->role->peran === 'petugas',
        ]);
    }
}
