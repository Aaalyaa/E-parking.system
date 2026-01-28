<?php

namespace App\Http\Controllers;

use App\Models\LokasiArea;
use Illuminate\Http\Request;

class LokasiAreaController extends Controller
{
    public function index()
    {
        $lokasiAreas = LokasiArea::all();
        return view('lokasi-area.index', compact('lokasiAreas'));
    }

    public function create()
    {
        return view('lokasi-area.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'lokasi_area' => 'required|string|max:255',
        ]);

        LokasiArea::create([
            'lokasi_area' => $request->lokasi_area,
        ]);

        return redirect()->route('lokasi-area.index');
    }

    public function edit(LokasiArea $lokasiArea)
    {
        return view('lokasi-area.edit', compact('lokasiArea'));
    }

    public function update(Request $request, LokasiArea $lokasiArea)
    {
        $request->validate([
            'lokasi_area' => 'required|string|max:255',
        ]);

        $lokasiArea->update([
            'lokasi_area' => $request->lokasi_area,
        ]);

        return redirect()->route('lokasi-area.index');
    }

    public function destroy(LokasiArea $lokasiArea)
    {
        $lokasiArea->delete();
        return redirect()->route('lokasi-area.index');
    }
}
