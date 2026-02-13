<?php

namespace App\Http\Controllers;

use App\Models\TipeKendaraan;
use Illuminate\Http\Request;
use App\Helpers\RoleHelper;
use App\Helpers\LogAktivitas;

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

        $tipeKendaraan = TipeKendaraan::create([
            'kode_tipe' => $kode,
            'nama_tipe' => $request->nama_tipe,
            'deskripsi' => $request->deskripsi,
        ]);

        LogAktivitas::add(
            'CREATE_TIPE_KENDARAAN',
            'Menambahkan tipe kendaraan baru: Kode Tipe ' . $kode . ', Nama Tipe ' . $request->nama_tipe,
            'tipe_kendaraan',
            $tipeKendaraan->id,
            null,
            null,
            $tipeKendaraan->toArray()
        );

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

        $before = $tipeKendaraan->getOriginal();

        $tipeKendaraan->update([
            'nama_tipe' => $request->nama_tipe,
            'deskripsi' => $request->deskripsi,
        ]);

        $after = $tipeKendaraan->fresh()->toArray();

        LogAktivitas::add(
            'UPDATE_TIPE_KENDARAAN',
            'Memperbarui tipe kendaraan: ID ' . $tipeKendaraan->id . ', Nama Tipe ' . $request->nama_tipe,
            'tipe_kendaraan',
            $tipeKendaraan->id,
            null,
            $before,
            $after
        );

        return redirect()->route('tipe-kendaraan.index');
    }

    public function destroy(TipeKendaraan $tipeKendaraan)
    {
        $before = $tipeKendaraan->toArray();

        $tipeKendaraan->delete();

        LogAktivitas::add(
            'DELETE_TIPE_KENDARAAN',
            'Menghapus tipe kendaraan: ID ' . $tipeKendaraan->id . ', Nama Tipe ' . $tipeKendaraan->nama_tipe,
            'tipe_kendaraan',
            $tipeKendaraan->id,
            null,
            $before
        );

        return redirect()->route('tipe-kendaraan.index');
    }
}
