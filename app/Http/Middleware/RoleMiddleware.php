<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $peran): Response
    {
        if (!auth()->check()) {
        abort(403, 'Belum login.');
    }

    $roles = explode('|', $peran);

    if (!in_array(auth()->user()->role->peran, $roles)) {
        abort(403, 'Aksi tidak diperbolehkan.');
    }

        return $next($request);
    }
}