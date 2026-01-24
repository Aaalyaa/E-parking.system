<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\LokasiArea;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function index()
    {
        $areas = Area::with('lokasiArea')->get();
        return view('admin.master.area.index', compact('areas'));
    }

    public function create()
    {
        $lokasi_areas = LokasiArea::all();
        return view('admin.master.area.create', compact('lokasi_areas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_area' => 'required',
            'id_lokasi_area' => 'required|exists:lokasi_area,id',
            'foto' => 'nullable|image|max:2048'
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('area_fotos', 'public');
        }

        Area::create([
            'nama_area' => $request->nama_area,
            'id_lokasi_area' => $request->id_lokasi_area,
            'foto' => $fotoPath
        ]);

        return redirect()->route('admin.master.area.index');
    }

    public function edit(Area $area)
    {
        $lokasi_areas = LokasiArea::all();
        return view('admin.master.area.edit', compact('area', 'lokasi_areas'));
    }

    public function update(Request $request, Area $area)
    {
        $request->validate([
            'nama_area' => 'required',
            'id_lokasi_area' => 'required|exists:lokasi_area,id',
            'foto' => 'nullable|image|max:2048'
        ]);

        $fotoPath = $area->foto;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('area_fotos', 'public');
        }

        $area->update([
            'nama_area' => $request->nama_area,
            'id_lokasi_area' => $request->id_lokasi_area,
            'foto' => $fotoPath
        ]);

        return redirect()->route('admin.master.area.index');
    }

    public function destroy(Area $area)
    {
        $area->delete();
        return redirect()->route('admin.master.area.index');
    }

    public function getByLokasi($id)
    {
        $areas = Area::where('id_lokasi_area', $id)->get();
        return response()->json($areas);
    }
}
