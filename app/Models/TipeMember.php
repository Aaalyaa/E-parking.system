<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipeMember extends Model
{
    use SoftDeletes;

    protected $table = 'tipe_member';

    protected $fillable = [
        'tipe_member',
        'masa_berlaku_bulanan',
        'harga',
        'diskon_persen',
    ];
    
    protected $dates = ['deleted_at'];

    public function members()
    {
        return $this->hasMany(Member::class, 'id_tipe_member');
    }
}
