<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataKendaraan extends Model
{
    use SoftDeletes;

    protected $table = 'data_kendaraan';

    protected $fillable = [
        'plat_nomor',
        'id_member',
        'id_tipe_kendaraan',
    ];

    protected $dates = ['deleted_at'];

    public function member()
    {
        return $this->belongsTo(Member::class, 'id_member');
    }

    public function tipe_kendaraan()
    {
        return $this->belongsTo(TipeKendaraan::class, 'id_tipe_kendaraan');
    }

    public function getMemberAktifAttribute()
    {
        return $this->member && $this->member->is_aktif;
    }

    public function getStatusMemberTextAttribute()
    {
        return $this->memberAktif ? 'Aktif' : 'Tidak Aktif';
    }
}
