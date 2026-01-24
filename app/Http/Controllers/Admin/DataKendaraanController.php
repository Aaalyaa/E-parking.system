<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataKendaraan;
use App\Models\TipeKendaraan;
use Illuminate\Http\Request;

class DataKendaraanController extends Controller
{
    public function index()
    {
        $dataKendaraan = DataKendaraan::with('tipe_kendaraan')->get();
        return view('admin.master.data_kendaraan.index', compact('dataKendaraan'));
    }

    public function create()
    {
        $tipeKendaraans = TipeKendaraan::all();
        return view('admin.master.data_kendaraan.create', compact('tipeKendaraans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'plat_nomor' => 'required|unique:data_kendaraan',
            'pemilik' => 'nullable',
            'id_tipe_kendaraan' => 'required|exists:tipe_kendaraan,id'
        ]);

        DataKendaraan::create($request->all());

        return redirect()->route('admin.master.data_kendaraan.index');
    }

    public function edit(DataKendaraan $dataKendaraan)
    {
        $tipeKendaraans = TipeKendaraan::all();
        return view('admin.master.data_kendaraan.edit', compact('dataKendaraan', 'tipeKendaraans'));
    }

    public function update(Request $request, DataKendaraan $dataKendaraan)
    {
        $request->validate([
            'plat_nomor' => 'required|unique:data_kendaraan,plat_nomor,' . $dataKendaraan->id,
            'id_tipe_kendaraan' => 'required|exists:tipe_kendaraan,id',
            'pemilik' => 'nullable'
        ]);

        $dataKendaraan->update($request->all());

        return redirect()->route('admin.master.data_kendaraan.index');
    }

    public function destroy(DataKendaraan $dataKendaraan)
    {
        $dataKendaraan->delete();
        return redirect()->route('admin.master.data_kendaraan.index');
    }
}
