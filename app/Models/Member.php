<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use SoftDeletes;
    
    protected $table = 'member';

    protected $fillable = [
        'nama_pemilik',
        'id_data_kendaraan',
        'id_tipe_member',
        'tanggal_bergabung',
        'tanggal_kadaluarsa',
    ];

    protected $casts = [
        'tanggal_bergabung'   => 'date',
        'tanggal_kadaluarsa'  => 'date',
    ];

    protected $dates = ['deleted_at'];

    public function kendaraan()
    {
        return $this->hasMany(DataKendaraan::class, 'id_member');
    }

    public function tipe_member()
    {
        return $this->belongsTo(TipeMember::class, 'id_tipe_member');
    }

    public function getIsAktifAttribute()
    {
        return now()->between(
            $this->tanggal_bergabung,
            $this->tanggal_kadaluarsa
        );
    }
}
