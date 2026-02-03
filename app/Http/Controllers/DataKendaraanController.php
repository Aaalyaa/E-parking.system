<?php

namespace App\Http\Controllers;

use App\Models\DataKendaraan;
use App\Models\TipeKendaraan;
use Illuminate\Http\Request;

class DataKendaraanController extends Controller
{
    public function index()
    {
        $dataKendaraan = DataKendaraan::with('tipe_kendaraan')->get();
        return view('data-kendaraan.index', compact('dataKendaraan'));
    }

    public function create()
    {
        $tipeKendaraans = TipeKendaraan::all()
            ->mapWithKeys(function ($tipe) {
                return [
                    $tipe->id => $tipe->kode_tipe . ' - ' . $tipe->nama_tipe
                ];
            });

        return view('data-kendaraan.create', compact('tipeKendaraans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'plat_nomor' => 'required|unique:data_kendaraan',
            'id_tipe_kendaraan' => 'required|exists:tipe_kendaraan,id'
        ]);

        DataKendaraan::create($request->all());

        return redirect()->route('data-kendaraan.index');
    }

    public function edit(DataKendaraan $dataKendaraan)
    {
        $tipeKendaraans = TipeKendaraan::all()
            ->mapWithKeys(fn($tipe) => [
                $tipe->id => $tipe->kode_tipe . ' - ' . $tipe->nama_tipe
            ]);

        return view('data-kendaraan.edit', compact('dataKendaraan', 'tipeKendaraans'));
    }

    public function update(Request $request, DataKendaraan $dataKendaraan)
    {
        $request->validate([
            'plat_nomor' => 'required|unique:data_kendaraan,plat_nomor,' . $dataKendaraan->id,
            'id_tipe_kendaraan' => 'required|exists:tipe_kendaraan,id',
        ]);

        $dataKendaraan->update($request->all());

        return redirect()->route('data-kendaraan.index');
    }

    public function destroy(DataKendaraan $dataKendaraan)
    {
        $dataKendaraan->delete();
        return redirect()->route('data-kendaraan.index');
    }
}
