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
        $members = Member::with(['data_kendaraan', 'tipe_member'])->get();
        return view('membership.index', compact('members'));
    }

    public function create()
    {
        $dataKendaraan = DataKendaraan::all();
        $tipeMembers = TipeMember::all();
        return view('membership.create', compact('dataKendaraan', 'tipeMembers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_data_kendaraan' => 'required|exists:data_kendaraan,id',
            'id_tipe_member' => 'required|exists:tipe_member,id',
        ]);

        $sudahAda = Member::where('id_data_kendaraan', $request->id_data_kendaraan)
                      ->exists();

        if ($sudahAda) {
            return back()->withErrors([
                'id_data_kendaraan' => 'Kendaraan ini sudah terdaftar sebagai member.'
            ])->withInput();
        }

        $tipeMember = TipeMember::find($request->id_tipe_member);

        $tanggalBergabung = now();
        $tanggalKadaluarsa = $tanggalBergabung->copy()->addMonths($tipeMember->masa_berlaku_bulanan);

        Member::create([
            'id_data_kendaraan' => $request->id_data_kendaraan,
            'id_tipe_member' => $request->id_tipe_member,
            'tanggal_bergabung' => $tanggalBergabung,
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
