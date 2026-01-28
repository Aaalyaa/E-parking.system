<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use App\Models\Area;
use Illuminate\Http\Request;

class LaporanOkupansiController extends Controller
{
    public function index()
    {
        $areas = Area::with(['lokasiArea', 'kapasitasArea.tipeKendaraan', 'transaksiAktif'])
        ->get();
        return view('laporan.okupansi.index', compact('areas'));
    }
}
