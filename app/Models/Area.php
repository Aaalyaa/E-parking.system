<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    use softDeletes;

    protected $table = 'area';

    protected $fillable = [
        'nama_area',
        'id_lokasi_area',
        'foto'
    ];

    protected $dates = ['deleted_at'];

    public function lokasiArea()
    {
        return $this->belongsTo(LokasiArea::class, 'id_lokasi_area')
            ->withTrashed();
    }

    public function kapasitasArea()
    {
        return $this->hasMany(KapasitasArea::class, 'id_area');
    }

    public function totalKapasitas()
    {
        return $this->hasMany(KapasitasArea::class, 'id_area')
            ->sum('kapasitas');
    }

    public function transaksiAktif()
    {
        return $this->hasMany(TransaksiParkir::class, 'id_area')
            ->whereNull('waktu_keluar');
    }

    public function slotTerpakai($idTipeKendaraan)
    {
        return $this->transaksiAktif()
            ->whereHas('dataKendaraan', function ($q) use ($idTipeKendaraan) {
                $q->where('id_tipe_kendaraan', $idTipeKendaraan);
            })
            ->count();
    }

    public function slotTersedia($idTipeKendaraan)
    {
        $kapasitas = KapasitasArea::where('id_area', $this->id)
            ->where('id_tipe_kendaraan', $idTipeKendaraan)
            ->value('kapasitas');

        $terpakai = $this->slotTerpakai($idTipeKendaraan);

        return max(0, $kapasitas - $terpakai);
    }
}
