<?php

namespace App\Http\Controllers;

use App\Models\TipeMember;
use Illuminate\Http\Request;

class TipeMemberController extends Controller
{
    public function index()
    {
        $tipeMembers = TipeMember::all();
        return view('tipe-member.index', compact('tipeMembers'));
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

        TipeMember::create($request->all());

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

        $tipeMember->update($request->all());

        return redirect()->route('tipe-member.index');
    }

    public function destroy(TipeMember $tipeMember)
    {
        $tipeMember->delete();
        return redirect()->route('tipe-member.index');
    }
}
