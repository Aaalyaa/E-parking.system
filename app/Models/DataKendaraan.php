<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKendaraan extends Model
{
    protected $table = 'data_kendaraan';

    protected $fillable = [
        'plat_nomor',
        'pemilik',
        'id_tipe_kendaraan',
    ];

    public function members()
    {
        return $this->hasMany(Member::class, 'id_data_kendaraan');
    }

    public function tipe_kendaraan()
    {
        return $this->belongsTo(TipeKendaraan::class, 'id_tipe_kendaraan');
    }

    public function memberAktif()
    {
        return $this->hasOne(Member::class, 'id_data_kendaraan')
            ->where('tanggal_bergabung', '<=', now())
            ->where('tanggal_kadaluarsa', '>=', now());
    }

    public function getStatusMemberTextAttribute()
    {
        return $this->memberAktif ? 'Aktif' : 'Tidak Aktif';
    }
}
