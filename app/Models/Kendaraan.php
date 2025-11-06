<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;

    protected $fillable = [
        'perusahaan_id',
        'no_polisi',
        'jenis',
        'merk',
        'kapasitas',
        'aktif',
    ];
    protected $table = 'kendaraan';

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class);
    }

    public function pengangkutan()
    {
        return $this->hasMany(Pengangkutan::class);
    }

    public function lokasiKendaraan()
    {
        return $this->hasMany(LokasiKendaraan::class);
    }
}
