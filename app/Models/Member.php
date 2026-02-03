<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'member';

    protected $fillable = [
        'id_data_kendaraan',
        'id_tipe_member',
        'tanggal_bergabung',
        'tanggal_kadaluarsa',
    ];

    protected $casts = [
        'tanggal_bergabung'   => 'date',
        'tanggal_kadaluarsa'  => 'date',
    ];

    public function data_kendaraan()
    {
        return $this->belongsTo(DataKendaraan::class, 'id_data_kendaraan');
    }

    public function tipe_member()
    {
        return $this->belongsTo(TipeMember::class, 'id_tipe_member');
    }
}
