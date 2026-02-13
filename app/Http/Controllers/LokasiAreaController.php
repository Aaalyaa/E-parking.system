<?php

namespace App\Http\Controllers;

use App\Models\LokasiArea;
use Illuminate\Http\Request;
use App\Helpers\RoleHelper;
use App\Helpers\LogAktivitas;

class LokasiAreaController extends Controller
{
    public function index()
    {
        $lokasiAreas = LokasiArea::all();
        return view('lokasi-area.index', [
        'lokasiAreas' => $lokasiAreas,
        'canCreate' => RoleHelper::isAdmin(),
    ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'lokasi_area' => 'required|string|max:255',
        ]);

        $lokasiArea = LokasiArea::create([
            'lokasi_area' => $request->lokasi_area,
        ]);

        LogAktivitas::add(
            'CREATE_LOKASI_AREA',
            'Menambahkan lokasi area baru: ' . $request->lokasi_area,
            'lokasi_area',
            $lokasiArea->id,
            null,
            null,
            $lokasiArea->toArray()
        );

        return redirect()->route('lokasi-area.index')
            ->with('success', 'Lokasi area berhasil ditambahkan!');
    }

    public function update(Request $request, LokasiArea $lokasiArea)
    {
        $request->validate([
            'lokasi_area' => 'required|string|max:255',
        ]);

        $before = $lokasiArea->getOriginal();

        $lokasiArea->update([
            'lokasi_area' => $request->lokasi_area,
        ]);

        $after = $lokasiArea->fresh()->toArray();

        LogAktivitas::add(
            'UPDATE_LOKASI_AREA',
            'Memperbarui lokasi area: ID ' . $lokasiArea->id . ', Lokasi Area ' . $request->lokasi_area,
            'lokasi_area',
            $lokasiArea->id,
            null,
            $before,
            $after
        );

        return redirect()->route('lokasi-area.index')
        ->with('success', 'Lokasi area berhasil diedit!');
    }

    public function destroy(LokasiArea $lokasiArea)
    {
        $before = $lokasiArea->toArray();

        $lokasiArea->delete();

        LogAktivitas::add(
            'DELETE_LOKASI_AREA',
            'Menghapus lokasi area: ID ' . $lokasiArea->id . ', Lokasi Area ' . $lokasiArea->lokasi_area,
            'lokasi_area',
            $lokasiArea->id,
            null,
            $before,
            null
        );

        return redirect()->route('lokasi-area.index');
    }
}
