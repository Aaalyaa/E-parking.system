<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogAktivitas extends Model
{
    protected $table = 'log_aktivitas';

    protected $fillable = [
        'id_user',
        'peran',
        'aksi',
        'deskripsi',
        'ref_table',
        'id_ref',
        'data_before',
        'data_after',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'metadata' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user')
            ->withTrashed();
    }
}
