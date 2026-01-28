<?php

namespace App\Http\Controllers;

use App\Models\Tarif;
use App\Models\TipeKendaraan;
use Illuminate\Http\Request;

class TarifController extends Controller
{
    public function index()
    {
        $tarifs = Tarif::with('tipe_kendaraan')->get();
        return view('tarif.index', compact('tarifs'));
    }

    public function create()
    {
        $tipeKendaraans = TipeKendaraan::all();
        return view('tarif.create', compact('tipeKendaraans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_tipe_kendaraan' => 'required|exists:tipe_kendaraan,id',
            'durasi_minimal' => 'required|integer|min:0',
            'durasi_maksimal' => 'required|integer|gte:durasi_minimal',
            'harga' => 'required|numeric|min:0',
        ]);

        Tarif::create($request->all());

        return redirect()->route('tarif.index');
    }

    public function edit(Tarif $tarif)
    {
        $tipeKendaraans = TipeKendaraan::all();
        return view('tarif.edit', compact('tarif', 'tipeKendaraans'));
    }

    public function update(Request $request, Tarif $tarif)
    {
        $request->validate([
            'id_tipe_kendaraan' => 'required|exists:tipe_kendaraan,id',
            'durasi_minimal' => 'required|integer|min:0',
            'durasi_maksimal' => 'required|integer|gte:durasi_minimal',
            'harga' => 'required|numeric|min:0',
        ]);

        $tarif->update($request->all());

        return redirect()->route('tarif.index');
    }

    public function destroy(Tarif $tarif)
    {
        $tarif->delete();
        return redirect()->route('tarif.index');
    }
}
