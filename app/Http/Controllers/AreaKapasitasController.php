<?php

namespace App\Http\Controllers;


use App\Models\TipeKendaraan;
use App\Models\LokasiArea;
use App\Models\Area;
use App\Models\KapasitasArea;
use Illuminate\Http\Request;

class AreaKapasitasController extends Controller
{
    public function index()
    {
        $kapasitasAreas = KapasitasArea::with(['lokasiArea', 'area', 'tipeKendaraan'])->get();
        return view('area-kapasitas.index', compact('kapasitasAreas'));
    }

    public function create()
    {        
        $lokasiAreas = LokasiArea::all();
        $areas = Area::all();
        $tipeKendaraans = TipeKendaraan::all();
        return view('area-kapasitas.create', compact('lokasiAreas','areas', 'tipeKendaraans'));
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

        return redirect()->route('area-kapasitas.index');
    }

    public function edit(KapasitasArea $kapasitasArea)
    {
        $lokasiAreas = LokasiArea::all();
        $areas = Area::all();
        $tipeKendaraans = TipeKendaraan::all();
        return view('area-kapasitas.edit', compact('lokasiAreas','kapasitasArea', 'areas', 'tipeKendaraans'));
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

        return redirect()->route('area-kapasitas.index');
    }

    public function destroy(KapasitasArea $kapasitasArea)
    {
        $kapasitasArea->delete();
        return redirect()->route('area-kapasitas.index');
    }
}
