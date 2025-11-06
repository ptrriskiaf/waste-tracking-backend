<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokasiKendaraan extends Model
{
    use HasFactory;

    protected $table = 'lokasi_kendaraan';

    protected $fillable = [
        'kendaraan_id',
        'lat',
        'lng',
        'speed',
        'recorded_at',
    ];

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }
}
