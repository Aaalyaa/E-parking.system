<?php

namespace App\Http\Controllers;

use App\Models\DataKendaraan;
use App\Models\Member;
use App\Models\TipeKendaraan;
use Illuminate\Http\Request;
use App\Helpers\RoleHelper;
use App\Helpers\LogAktivitas;

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

        $dataKendaraan = DataKendaraan::create([
            'plat_nomor' => $request->plat_nomor,
            'id_tipe_kendaraan' => $request->id_tipe_kendaraan,
            'id_member' => $request->id_member
        ]);

        LogAktivitas::add(
            'CREATE_DATA_KENDARAAN',
            'Menambahkan data kendaraan baru: Plat Nomor ' . $request->plat_nomor,
            'data_kendaraan',
            $dataKendaraan->id,
            null,
            null,
            $dataKendaraan->toArray()
        );

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

        $before = $dataKendaraan->getOriginal();

        $dataKendaraan->update([
            'plat_nomor' => $request->plat_nomor,
            'id_tipe_kendaraan' => $request->id_tipe_kendaraan,
            'id_member' => $request->id_member
        ]);

        $after = $dataKendaraan->fresh()->toArray();

        LogAktivitas::add(
            'UPDATE_DATA_KENDARAAN',
            'Memperbarui data kendaraan: ID ' . $dataKendaraan->id . ', Plat Nomor ' . $request->plat_nomor,
            'data_kendaraan',
            $dataKendaraan->id,
            null,
            $before,
            $after
        );

        return redirect()->route('data-kendaraan.index');
    }

    public function destroy(DataKendaraan $dataKendaraan)
    {
        $before = $dataKendaraan->toArray();

        $dataKendaraan->delete();

        LogAktivitas::add(
            'DELETE_DATA_KENDARAAN',
            'Menghapus data kendaraan: ID ' . $dataKendaraan->id . ', Plat Nomor ' . $dataKendaraan->plat_nomor,
            'data_kendaraan',
            $dataKendaraan->id,
            null,
            $before,
            null
        );

        return redirect()->route('data-kendaraan.index');
    }
}
