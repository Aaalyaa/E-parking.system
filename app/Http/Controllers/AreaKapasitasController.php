<?php

namespace App\Http\Controllers;


use App\Models\TipeKendaraan;
use App\Models\LokasiArea;
use App\Models\Area;
use App\Models\KapasitasArea;
use Illuminate\Http\Request;
use App\Helpers\RoleHelper;
use App\Helpers\LogAktivitas;

class AreaKapasitasController extends Controller
{
    public function index()
    {
        $kapasitasAreas = KapasitasArea::with(['lokasiArea', 'area', 'tipeKendaraan'])->get();
        return view('area-kapasitas.index', [
            'kapasitasAreas' => $kapasitasAreas,
            'canCreate' => RoleHelper::isAdmin(),
        ]);
    }

    public function create()
    {
        $lokasiAreas = LokasiArea::all();
        $areas = Area::all();
        $tipeKendaraans = TipeKendaraan::all();
        return view('area-kapasitas.create', compact('lokasiAreas', 'areas', 'tipeKendaraans'));
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

        LogAktivitas::add(
            'CREATE_KAPASITAS_AREA',
            'Menambahkan kapasitas area baru: Lokasi Area ID ' . $request->id_lokasi_area . ', Area ID ' . $request->id_area . ', Tipe Kendaraan ID ' . $request->id_tipe_kendaraan . ', Kapasitas ' . $request->kapasitas,
            'kapasitas_area',
            null
        );

        return redirect()->route('area-kapasitas.index');
    }

    public function edit(KapasitasArea $kapasitasArea)
    {
        $lokasiAreas = LokasiArea::all();
        $areas = Area::all();
        $tipeKendaraans = TipeKendaraan::all();
        return view('area-kapasitas.edit', compact('lokasiAreas', 'kapasitasArea', 'areas', 'tipeKendaraans'));
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

        LogAktivitas::add(
            'UPDATE_KAPASITAS_AREA',
            'Memperbarui kapasitas area: ID ' . $kapasitasArea->id . ', Lokasi Area ID ' . $request->id_lokasi_area . ', Area ID ' . $request->id_area . ', Tipe Kendaraan ID ' . $request->id_tipe_kendaraan . ', Kapasitas ' . $request->kapasitas,
            'kapasitas_area',
            $kapasitasArea->id
        );

        return redirect()->route('area-kapasitas.index');
    }

    public function destroy(KapasitasArea $kapasitasArea)
    {
        $kapasitasArea->delete();

        LogAktivitas::add(
            'DELETE_KAPASITAS_AREA',
            'Menghapus kapasitas area: ID ' . $kapasitasArea->id . ', Lokasi Area ID ' . $kapasitasArea->id_lokasi_area . ', Area ID ' . $kapasitasArea->id_area . ', Tipe Kendaraan ID ' . $kapasitasArea->id_tipe_kendaraan . ', Kapasitas ' . $kapasitasArea->kapasitas,
            'kapasitas_area',
            $kapasitasArea->id
        );

        return redirect()->route('area-kapasitas.index');
    }
}
