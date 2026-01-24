<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeKendaraan extends Model
{
    protected $table = 'tipe_kendaraan';

    protected $fillable = [
        'kode_tipe',
        'nama_tipe',
        'deskripsi',
        'ukuran_slot'
    ];

    public function kapasitasArea()
    {
        return $this->hasMany(KapasitasArea::class, 'id_tipe_kendaraan');
    }

    public function dataKendaraan()
    {
        return $this->hasMany(DataKendaraan::class, 'id_tipe_kendaraan');
    }
}
