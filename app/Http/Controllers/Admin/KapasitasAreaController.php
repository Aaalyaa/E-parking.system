<?php

namespace App\Http\Controllers\Admin;

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
        return view('admin.master.kapasitas_area.index', compact('kapasitasAreas'));
    }

    public function create()
    {
        $lokasiAreas = LokasiArea::all();
        $areas = Area::all();
        $tipeKendaraans = TipeKendaraan::all();
        return view('admin.master.kapasitas_area.create', compact('lokasiAreas','areas', 'tipeKendaraans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_lokasi_area' => 'required|exists:lokasi_area,id',
            'id_area' => 'required|exists:area,id',
            'id_tipe_kendaraan' => 'required|exists:tipe_kendaraan,id',
            'kapasitas' => 'required|integer|min:0'
        ]);

        KapasitasArea::create($request->all());

        return redirect()->route('admin.master.kapasitas_area.index');
    }

    public function edit(KapasitasArea $kapasitasArea)
    {
        $lokasiAreas = LokasiArea::all();
        $areas = Area::all();
        $tipeKendaraans = TipeKendaraan::all();
        return view('admin.master.kapasitas_area.edit', compact('lokasiAreas','kapasitasArea', 'areas', 'tipeKendaraans'));
    }

    public function update(Request $request, KapasitasArea $kapasitasArea)
    {
        $request->validate([
            'id_area' => 'required|exists:area,id',
            'id_lokasi_area' => 'required|exists:lokasi_area,id',
            'id_tipe_kendaraan' => 'required|exists:tipe_kendaraan,id',
            'kapasitas' => 'required|integer|min:0'
        ]);

        $kapasitasArea->update($request->all());

        return redirect()->route('admin.master.kapasitas_area.index');
    }

    public function destroy(KapasitasArea $kapasitasArea)
    {
        $kapasitasArea->delete();
        return redirect()->route('admin.master.kapasitas_area.index');
    }
}
