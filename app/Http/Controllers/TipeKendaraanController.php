<?php

namespace App\Http\Controllers;

use App\Models\TipeKendaraan;
use Illuminate\Http\Request;
use App\Helpers\RoleHelper;

class TipeKendaraanController extends Controller
{
    private function generateKodeTipe($nama)
    {
        $nama = strtoupper(preg_replace('/[^A-Z]/i', '', $nama));

        if (strlen($nama) >= 3) {
            return substr($nama, 0, 3);
        }

        return str_pad($nama, 3, 'X');
    }

    public function index()
    {
        $tipe_kendaraan = TipeKendaraan::all();
        return view('tipe-kendaraan.index', [
            'tipe_kendaraan' => $tipe_kendaraan,
            'canCreate' => RoleHelper::isAdmin(),
        ]);
    }

    public function create()
    {
        return view('tipe-kendaraan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_tipe' => 'required',
            'deskripsi' => 'nullable',
        ]);

        $kode = $this->generateKodeTipe($request->nama_tipe);

        TipeKendaraan::create([
            'kode_tipe' => $kode,
            'nama_tipe' => $request->nama_tipe,
            'deskripsi' => $request->deskripsi,
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
            'nama_tipe' => 'required',
            'deskripsi' => 'nullable',
        ]);

        $tipeKendaraan->update([
            'nama_tipe' => $request->nama_tipe,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('tipe-kendaraan.index');
    }

    public function destroy(TipeKendaraan $tipeKendaraan)
    {
        $tipeKendaraan->delete();
        return redirect()->route('tipe-kendaraan.index');
    }
}
