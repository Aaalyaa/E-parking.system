<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LokasiArea extends Model
{
    use SoftDeletes;

    protected $table = 'lokasi_area';

    protected $fillable = ['lokasi_area'];

    protected $dates = ['deleted_at'];

    public function area()
    {
        return $this->hasMany(Area::class, 'id_lokasi_area');
    }

    public function kapasitas_area()
    {
        return $this->hasMany(KapasitasArea::class, 'id_lokasi_area');
    }
}
