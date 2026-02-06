<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\DataKendaraan;
use App\Models\TipeMember;
use Illuminate\Http\Request;
use App\Helpers\RoleHelper;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $query = Member::with(['tipe_member'])
            ->withCount('kendaraan');

        if ($request->filled('status')) {
            if ($request->status === 'aktif') {
                $query->whereDate('tanggal_kadaluarsa', '>=', now());
            } elseif ($request->status === 'nonaktif') {
                $query->whereDate('tanggal_kadaluarsa', '<', now());
            }
        }

        if ($request->filled('nama')) {
            $query->where('nama_pemilik', 'like', '%' . $request->nama . '%');
        }

        return view('membership.index', [
            'members' => $query->get(),
            'canCreate' => RoleHelper::isAdmin(),
        ]);
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
