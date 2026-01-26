<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            return back()->withErrors([
                'username' => 'Username atau Password salah.',
            ]);
        }

        $request->session()->regenerate();

        $peran = Auth::user()->role->peran;

        return match ($peran) {
            'admin' => redirect()->intended('/admin/dashboard'),
            'petugas' => redirect()->intended('/petugas/dashboard'),
            'owner' => redirect()->intended('/owner/dashboard'),
            default => abort(403, 'Aksi tidak diperbolehkan.'),
        };
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
