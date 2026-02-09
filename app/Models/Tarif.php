<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tarif extends Model
{
    use SoftDeletes;

    protected $table = 'tarif';

    protected $fillable = [
        'id_tipe_kendaraan',
        'durasi_minimal',
        'durasi_maksimal',
        'harga',
    ];

    protected $dates = ['deleted_at'];

    public function tipe_kendaraan()
    {
        return $this->belongsTo(TipeKendaraan::class, 'id_tipe_kendaraan')
            ->withTrashed();
    }

    public function transaksiParkir()
    {
        return $this->hasMany(TransaksiParkir::class, 'id_tarif');
    }
}
