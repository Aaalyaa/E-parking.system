<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\TipeMember;
use Illuminate\Http\Request;
use App\Helpers\RoleHelper;
use App\Helpers\LogAktivitas;

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

        $member = Member::create([
            'nama_pemilik'       => $request->nama_pemilik,
            'id_tipe_member'     => $request->id_tipe_member,
            'tanggal_bergabung'  => $tanggalBergabung,
            'tanggal_kadaluarsa' => $tanggalKadaluarsa,
        ]);

        LogAktivitas::add(
            'CREATE_MEMBER',
            'Menambahkan member baru: Nama Pemilik ' . $request->nama_pemilik . ', Tipe Member ID ' . $request->id_tipe_member,
            'member',
            $member->id,
            null,
            null,
            $member->toArray()
        );

        return redirect()->route('membership.index')
            ->with('success', 'Member baru berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $member = Member::findOrFail($id);
        $tipeMembers = TipeMember::pluck('tipe_member', 'id');

        return view('membership.edit', compact('member', 'tipeMembers'));
    }

    public function update(Request $request, $id)
    {
        $member = Member::findOrFail($id);

        $request->validate([
            'nama_pemilik'   => 'required|string|max:255',
            'id_tipe_member' => 'required|exists:tipe_member,id',
        ]);

        $tipeBaru = TipeMember::findOrFail($request->id_tipe_member);

        $startDate = now()->greaterThan($member->tanggal_kadaluarsa)
            ? now()
            : $member->tanggal_kadaluarsa;

        $before = $member->getOriginal();

        $member->update([
            'nama_pemilik'       => $request->nama_pemilik,
            'id_tipe_member'     => $request->id_tipe_member,
            'tanggal_kadaluarsa' => $startDate->copy()->addMonths($tipeBaru->masa_berlaku_bulanan),
        ]);

        $after = $member->fresh()->toArray();

        LogAktivitas::add(
            'UPDATE_MEMBER',
            'Memperbarui member: ID ' . $member->id . ', Nama Pemilik ' . $request->nama_pemilik . ', Tipe Member ID ' . $request->id_tipe_member,
            'member',
            $member->id,
            null,
            $before,
            $after
        );

        return redirect()->route('membership.index')
            ->with('success', 'Data membership berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $member = Member::findOrFail($id);

        $before = $member->toArray();

        $member->delete();

        LogAktivitas::add(
            'DELETE_MEMBER',
            'Menghapus member: ID ' . $member->id . ', Nama Pemilik ' . $member->nama_pemilik,
            'member',
            $member->id,
            null,
            $before,
            null
        );

        return redirect()->route('membership.index')
            ->with('success', 'Member berhasil dihapus.');
    }

    public function extend($id)
    {
        $member = Member::with('tipe_member')->findOrFail($id);

        $before = [
            'tanggal_kadaluarsa' => $member->tanggal_kadaluarsa?->toDateString(),
        ];

        $masaBerlaku = $member->tipe_member->masa_berlaku_bulanan;

        $startDate = now()->greaterThan($member->tanggal_kadaluarsa)
            ? now()
            : $member->tanggal_kadaluarsa;

        $member->tanggal_kadaluarsa = $startDate->copy()->addMonths($masaBerlaku);
        $member->save();

        $after = [
            'tanggal_kadaluarsa' => $member->tanggal_kadaluarsa->toDateString(),
            'masa_berlaku_bulan' => $masaBerlaku,
            'start_date_dihitung_dari' => $startDate->toDateString(),
        ];

        LogAktivitas::add(
            'EXTEND_MEMBER',
            'Memperpanjang membership: ID ' . $member->id . ', Nama Pemilik ' . $member->nama_pemilik . ', Tipe Member ID ' . $member->id_tipe_member . ', Masa Berlaku Baru ' . $member->tanggal_kadaluarsa->toDateString(),
            'member',
            $member->id,
            null,
            $before,
            $after
        );

        return redirect()->route('membership.index')
            ->with('success', 'Masa membership berhasil diperpanjang.');
    }
}
