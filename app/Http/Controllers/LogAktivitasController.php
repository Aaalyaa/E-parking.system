<?php

namespace App\Http\Controllers;

use App\Models\LogAktivitas;
use Illuminate\Http\Request;

class LogAktivitasController extends Controller
{
    public function index(Request $request)
    {
        $logs = LogAktivitas::with('user')
        ->when($request->username, function ($query) use ($request) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('username', 'like', '%' . $request->username . '%');
            });
        })
        ->when($request->peran, function ($query) use ($request) {
            $query->where('peran', $request->peran);
        })
        ->orderBy('created_at', 'desc')
        ->paginate(15)
        ->withQueryString();

        return view('log-aktivitas.index', compact('logs'));
    }
}
