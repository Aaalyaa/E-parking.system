<?php

namespace App\Http\Controllers;

use App\Models\TipeKendaraan;
use Illuminate\Http\Request;

class TipeKendaraanController extends Controller
{
    public function index()
    {
        $tipe_kendaraan = TipeKendaraan::all();
        return view('tipe-kendaraan.index', compact('tipe_kendaraan'));
    }

    public function create()
    {
        return view('tipe-kendaraan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_tipe' => 'required|unique:tipe_kendaraan',
            'nama_tipe' => 'required',
            'deskripsi' => 'nullable',
            'ukuran_slot' => 'required'
        ]);

        TipeKendaraan::create([
            'kode_tipe' => $request->kode_tipe,
            'nama_tipe' => $request->nama_tipe,
            'deskripsi' => $request->deskripsi,
            'ukuran_slot' => $request->ukuran_slot
        ]);

        return redirect()->route('tipe-kendaraan.index');
    }

    public function edit(TipeKendaraan $tipeKendaraan)
    {
        return view('tipe-kendaraan.edit', compact('tipeKendaraan'));
    }

    public function update(Request $request, TipeKendaraan $tipeKendaraan)
    {
        $request->validate([
            'kode_tipe' => 'required',
            'nama_tipe' => 'required',
            'deskripsi' => 'nullable',
            'ukuran_slot' => 'required'
        ]);

        $tipeKendaraan->update([
            'kode_tipe' => $request->kode_tipe,
            'nama_tipe' => $request->nama_tipe,
            'deskripsi' => $request->deskripsi,
            'ukuran_slot' => $request->ukuran_slot
        ]);

        return redirect()->route('tipe-kendaraan.index');
    }

    public function destroy(TipeKendaraan $tipeKendaraan)
    {
        $tipeKendaraan->delete();
        return redirect()->route('tipe-kendaraan.index');
    }
}
