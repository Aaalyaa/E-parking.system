<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KapasitasArea extends Model
{
    use SoftDeletes;
    
    protected $table = 'area_kapasitas';

    protected $fillable = [
        'id_area',
        'id_lokasi_area',
        'id_tipe_kendaraan',
        'kapasitas'
    ];

    public function lokasiArea()
    {
        return $this->belongsTo(LokasiArea::class, 'id_lokasi_area')
            ->withTrashed();
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'id_area')
            ->withTrashed();
    }

    public function tipeKendaraan()
    {
        return $this->belongsTo(TipeKendaraan::class, 'id_tipe_kendaraan')
            ->withTrashed();
    }
}
