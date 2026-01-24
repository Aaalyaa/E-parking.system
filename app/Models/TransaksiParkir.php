<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiParkir extends Model
{
    const STATUS_IN  = 'IN';
    const STATUS_OUT = 'OUT';

    protected $table = 'transaksi_parkir';

    protected $fillable = [
        'kode',
        'id_data_kendaraan',
        'id_area',
        'id_tarif',
        'waktu_masuk',
        'waktu_keluar',
        'durasi_parkir',
        'status_parkir',
        'diskon_persen',
        'diskon_nominal',
        'total_biaya',
        'metode_bayar',
    ];

    protected $casts = [
        'waktu_masuk' => 'datetime',
        'waktu_keluar' => 'datetime',
    ];

    public function dataKendaraan()
    {
        return $this->belongsTo(DataKendaraan::class, 'id_data_kendaraan');
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'id_area');
    }
    
    public function tarif()
    {
        return $this->belongsTo(Tarif::class, 'id_tarif');
    }

    public static function generateNomorStruk()
    {
        $tanggal = now()->format('Ymd');

        $last = self::whereDate('created_at', today())
            ->orderBy('id', 'desc')
            ->first();

        $urutan = $last ? ((int) substr($last->id, -4)) + 1 : 1;

        return 'TKT-' . $tanggal . '-' . str_pad($urutan, 4, '0', STR_PAD_LEFT);
    }

    public function getDurasiFormatAttribute()
    {
        if (!$this->waktu_keluar) {
            return '-';
        }

        $menit = $this->waktu_masuk->diffInMinutes($this->waktu_keluar);

        $jam = intdiv($menit, 60);
        $sisaMenit = $menit % 60;

        return $jam . ' jam ' . $sisaMenit . ' menit';
    }
}
