<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DataKendaraan extends Model
{
    protected $table = 'data_kendaraan';

    protected $fillable = [
        'plat_nomor',
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
            ->whereDate('tanggal_kadaluarsa', '>=', Carbon::today());
    }

    public function getStatusMemberTextAttribute()
    {
        return $this->memberAktif ? 'Aktif' : 'Tidak Aktif';
    }
}
