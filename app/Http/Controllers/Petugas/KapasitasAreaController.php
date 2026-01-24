<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\TipeKendaraan;
use App\Models\LokasiArea;
use App\Models\Area;
use App\Models\KapasitasArea;
use Illuminate\Http\Request;

class KapasitasAreaController extends Controller
{
    public function index()
    {
        $kapasitasAreas = KapasitasArea::with(['lokasiArea', 'area', 'tipeKendaraan'])->get();
        return view('petugas.master.kapasitas_area.index', compact('kapasitasAreas'));
    }
}
