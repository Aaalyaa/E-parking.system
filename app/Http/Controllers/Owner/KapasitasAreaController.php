<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\KapasitasArea;
use Illuminate\Http\Request;

class KapasitasAreaController extends Controller
{
    public function index()
    {
        $kapasitasAreas = KapasitasArea::with(['lokasiArea', 'area', 'tipeKendaraan'])->get();
        return view('owner.master.kapasitas_area.index', compact('kapasitasAreas'));
    }
}
