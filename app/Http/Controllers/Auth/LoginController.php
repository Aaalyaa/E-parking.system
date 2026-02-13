<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\LogAktivitas;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (!Auth::attempt($credentials)) {

            $user = User::where('username', $request->username)->first();

            $peran = $user?->role?->peran ?? 'unknown';

            LogAktivitas::add(
                'LOGIN_GAGAL',
                'Gagal login sebagai ' . $peran,
                null,
                null,
                $user
            );

            return back()->withErrors([
                'username' => 'Username atau Password salah.',
            ]);
        }

        $request->session()->regenerate();

        $peran = Auth::user()->role->peran;

        LogAktivitas::add(
            'LOGIN',
            'Login sebagai ' . $peran
        );

        return match ($peran) {
            'admin' => redirect()->route('admin.dashboard'),
            'petugas' => redirect()->route('petugas.dashboard'),
            'owner' => redirect()->route('owner.dashboard'),
            default => abort(403, 'Aksi tidak diperbolehkan.'),
        };
    }

    public function logout(Request $request)
    {
        LogAktivitas::add(
            'LOGOUT',
            'Logout dari sistem'
        );

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
