<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KapasitasArea extends Model
{
    protected $table = 'area_kapasitas';

    protected $fillable = [
        'id_area',
        'id_lokasi_area',
        'id_tipe_kendaraan',
        'kapasitas'
    ];

    public function lokasiArea()
    {
        return $this->belongsTo(LokasiArea::class, 'id_lokasi_area');
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'id_area');
    }

    public function tipeKendaraan()
    {
        return $this->belongsTo(TipeKendaraan::class, 'id_tipe_kendaraan');
    }
}
