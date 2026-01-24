<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarif extends Model
{
    protected $table = 'tarif';

    protected $fillable = [
        'id_tipe_kendaraan',
        'durasi_minimal',
        'durasi_maksimal',
        'harga',
    ];

    public function tipe_kendaraan()
    {
        return $this->belongsTo(TipeKendaraan::class, 'id_tipe_kendaraan');
    }

    public function transaksiParkir()
    {
        return $this->hasMany(TransaksiParkir::class, 'id_tarif');
    }
}
