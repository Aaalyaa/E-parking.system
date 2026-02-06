<?php

namespace App\Http\Controllers;

use App\Models\DataKendaraan;
use App\Models\Member;
use App\Models\TipeKendaraan;
use Illuminate\Http\Request;
use App\Helpers\RoleHelper;

class DataKendaraanController extends Controller
{
    public function index(Request $request)
    {
        $query = DataKendaraan::with(['tipe_kendaraan', 'member']);

        if ($request->filled('nama')) {
            $query->whereHas('member', function ($q) use ($request) {
                $q->where('nama_pemilik', 'like', '%' . $request->nama . '%');
            });
        }

        if ($request->filled('tipe')) {
            $query->where('id_tipe_kendaraan', $request->tipe);
        }

        if ($request->filled('plat')) {
            $query->where('plat_nomor', 'like', '%' . $request->plat . '%');
        }

        return view('data-kendaraan.index', [
            'dataKendaraan' => $query->get(),
            'tipeKendaraan' => TipeKendaraan::all(),
            'canCreate' => RoleHelper::isAdmin(),
        ]);
    }

    public function create()
    {
        $tipeKendaraans = TipeKendaraan::all()
            ->mapWithKeys(fn($tipe) => [
                $tipe->id => $tipe->kode_tipe . ' - ' . $tipe->nama_tipe
            ]);

        $members = Member::all()
            ->mapWithKeys(fn($m) => [
                $m->id => $m->nama_pemilik
            ]);

        return view('data-kendaraan.create', compact('tipeKendaraans', 'members'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'plat_nomor' => 'required|unique:data_kendaraan',
            'id_tipe_kendaraan' => 'required|exists:tipe_kendaraan,id',
            'id_member' => 'nullable|exists:member,id'
        ]);

        DataKendaraan::create([
            'plat_nomor' => $request->plat_nomor,
            'id_tipe_kendaraan' => $request->id_tipe_kendaraan,
            'id_member' => $request->id_member
        ]);

        return redirect()->route('data-kendaraan.index');
    }

    public function edit(DataKendaraan $dataKendaraan)
    {
        $tipeKendaraans = TipeKendaraan::all()
            ->mapWithKeys(fn($tipe) => [
                $tipe->id => $tipe->kode_tipe . ' - ' . $tipe->nama_tipe
            ]);

        $members = Member::all()
            ->mapWithKeys(fn($m) => [
                $m->id => $m->nama_pemilik
            ]);

        return view('data-kendaraan.edit', compact('dataKendaraan', 'tipeKendaraans', 'members'));
    }

    public function update(Request $request, DataKendaraan $dataKendaraan)
    {
        $request->validate([
            'plat_nomor' => 'required|unique:data_kendaraan,plat_nomor,' . $dataKendaraan->id,
            'id_tipe_kendaraan' => 'required|exists:tipe_kendaraan,id',
            'id_member' => 'nullable|exists:member,id'
        ]);

        $dataKendaraan->update([
            'plat_nomor' => $request->plat_nomor,
            'id_tipe_kendaraan' => $request->id_tipe_kendaraan,
            'id_member' => $request->id_member
        ]);

        return redirect()->route('data-kendaraan.index');
    }

    public function destroy(DataKendaraan $dataKendaraan)
    {
        $dataKendaraan->delete();
        return redirect()->route('data-kendaraan.index');
    }
}
