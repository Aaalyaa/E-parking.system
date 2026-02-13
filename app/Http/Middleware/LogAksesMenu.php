<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Helpers\LogAktivitas;

class LogAksesMenu
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {

            LogAktivitas::add(
                'AKSES_MENU',
                'Mengakses menu: ' . $request->path()
            );
        }

        return $next($request);
    }
}
