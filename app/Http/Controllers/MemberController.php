<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\DataKendaraan;
use App\Models\TipeMember;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::with(['kendaraan', 'tipe_member'])->get();
        return view('membership.index', compact('members'));
    }

    public function create()
    {
        $tipeMembers = TipeMember::all();
        return view('membership.create', compact('tipeMembers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pemilik'   => 'required|string|max:255',
            'id_tipe_member' => 'required|exists:tipe_member,id',
        ]);

        $tipeMember = TipeMember::findOrFail($request->id_tipe_member);

        $tanggalBergabung = now();
        $tanggalKadaluarsa = $tanggalBergabung
            ->copy()
            ->addMonths($tipeMember->masa_berlaku_bulanan);

        Member::create([
            'nama_pemilik'       => $request->nama_pemilik,
            'id_tipe_member'     => $request->id_tipe_member,
            'tanggal_bergabung'  => $tanggalBergabung,
            'tanggal_kadaluarsa' => $tanggalKadaluarsa,
        ]);

        return redirect()->route('membership.index')
            ->with('success', 'Member baru berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $member = Member::findOrFail($id);
        $member->delete();

        return redirect()->route('membership.index')
            ->with('success', 'Member berhasil dihapus.');
    }
}
