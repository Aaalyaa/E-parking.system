<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LogAktivitas
{
    public static function add(
        string $aksi,
        ?string $deskripsi = null,
        ?string $refTable = null,
        ?int $idRef = null,
        $userOverride = null,
        ?array $before = null,
        ?array $after = null
    ): void {
        $user = $userOverride ?? Auth::user();

        DB::table('log_aktivitas')->insert([
            'id_user'    => $user?->id,
            'peran'      => $user?->role?->peran,
            'aksi'       => $aksi,
            'deskripsi'  => $deskripsi,
            'ref_table'  => $refTable,
            'id_ref'     => $idRef,
            'data_before' => $before ? json_encode($before) : null,
            'data_after'  => $after ? json_encode($after) : null,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
