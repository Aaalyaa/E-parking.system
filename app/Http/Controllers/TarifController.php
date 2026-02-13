<?php

namespace App\Http\Controllers;

use App\Models\LogAktivitas;
use App\Models\Tarif;
use App\Models\TipeKendaraan;
use Illuminate\Http\Request;
use App\Helpers\RoleHelper;

class TarifController extends Controller
{
    public function index()
    {
        $tarifs = Tarif::with('tipe_kendaraan')->get();
        return view('tarif.index', [
        'tarifs' => $tarifs,
        'canCreate' => RoleHelper::isAdmin(),
    ]);
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
            'tarif_per_jam' => 'required|numeric|min:0',
        ]);

        $tarif = Tarif::create($request->all());

        LogAktivitas::add(
            'CREATE_TARIF',
            'Menambahkan tarif baru: Tipe Kendaraan ID ' . $request->id_tipe_kendaraan . ', Tarif Per Jam ' . $request->tarif_per_jam,
            'tarif',
            $tarif->id,
            null,
            null,
            $tarif->toArray()
        );

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
            'tarif_per_jam' => 'required|numeric|min:0',
        ]);

        $before = $tarif->getOriginal();

        $tarif->update($request->all());

        $after = $tarif->fresh()->toArray();

        LogAktivitas::add(
            'UPDATE_TARIF',
            'Memperbarui tarif: ID ' . $tarif->id . ', Tipe Kendaraan ID ' . $request->id_tipe_kendaraan . ', Tarif Per Jam ' . $request->tarif_per_jam,
            'tarif',
            $tarif->id,
            null,
            $before,
            $after
        );

        return redirect()->route('tarif.index');
    }

    public function destroy(Tarif $tarif)
    {
        $before = $tarif->toArray();

        $tarif->delete();

        LogAktivitas::add(
            'DELETE_TARIF',
            'Menghapus tarif: ID ' . $tarif->id . ', Tipe Kendaraan ID ' . $tarif->id_tipe_kendaraan . ', Tarif Per Jam ' . $tarif->tarif_per_jam,
            'tarif',
            $tarif->id,
            null,
            $before,
            null
        );

        return redirect()->route('tarif.index');
    }
}
