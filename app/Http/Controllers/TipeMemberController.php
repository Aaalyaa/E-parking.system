<?php

namespace App\Http\Controllers;

use App\Models\TipeMember;
use Illuminate\Http\Request;
use App\Helpers\RoleHelper;
use App\Helpers\LogAktivitas;

class TipeMemberController extends Controller
{
    public function index()
    {
        $tipeMembers = TipeMember::all();
        return view('tipe-member.index', [
            'tipeMembers' => $tipeMembers,
            'canCreate' => RoleHelper::isAdmin(),
        ]);
    }

    public function create()
    {
        return view('tipe-member.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipe_member' => 'required|string|max:255',
            'masa_berlaku_bulanan' => 'required|integer|min:1|max:12',
            'harga' => 'required|integer|min:0',
            'diskon_persen' => 'required|numeric|min:0|max:100',
        ]);

        $tipeMember = TipeMember::create($request->all());

        LogAktivitas::add(
            'CREATE_TIPE_MEMBER',
            'Menambahkan tipe member baru: Tipe Member ' . $request->tipe_member . ', Masa Berlaku Bulanan ' . $request->masa_berlaku_bulanan . ', Harga ' . $request->harga . ', Diskon Persen ' . $request->diskon_persen,
            'tipe_member',
            $tipeMember->id,
            null,
            null,
            $tipeMember->toArray()
        );

        return redirect()->route('tipe-member.index');
    }

    public function edit(TipeMember $tipeMember)
    {
        return view('tipe-member.edit', compact('tipeMember'));
    }

    public function update(Request $request, TipeMember $tipeMember)
    {
        $request->validate([
            'tipe_member' => 'required|string|max:255',
            'masa_berlaku_bulanan' => 'required|integer|min:0',
            'harga' => 'required|integer|min:0',
            'diskon_persen' => 'required|numeric|min:0|max:100',
        ]);

        $before = $tipeMember->getOriginal();

        $tipeMember->update($request->all());

        $after = $tipeMember->fresh()->toArray();

        LogAktivitas::add(
            'UPDATE_TIPE_MEMBER',
            'Memperbarui tipe member: ID ' . $tipeMember->id . ', Tipe Member ' . $request->tipe_member . ', Masa Berlaku Bulanan ' . $request->masa_berlaku_bulanan . ', Harga ' . $request->harga . ', Diskon Persen ' . $request->diskon_persen,
            'tipe_member',
            $tipeMember->id,
            null,
            $before,
            $after
        );

        return redirect()->route('tipe-member.index');
    }

    public function destroy(TipeMember $tipeMember)
    {
        $before = $tipeMember->toArray();

        $tipeMember->delete();

        LogAktivitas::add(
            'DELETE_TIPE_MEMBER',
            'Menghapus tipe member: ID ' . $tipeMember->id . ', Tipe Member ' . $tipeMember->tipe_member,
            'tipe_member',
            $tipeMember->id,
            null,
            $before,
            null
        );

        return redirect()->route('tipe-member.index');
    }
}
