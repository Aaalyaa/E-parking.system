<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeMember extends Model
{
    protected $table = 'tipe_member';

    protected $fillable = [
        'tipe_member',
        'masa_berlaku_bulanan',
        'harga',
        'diskon_persen',
    ];

    public function members()
    {
        return $this->hasMany(Member::class, 'id_tipe_member');
    }
}
