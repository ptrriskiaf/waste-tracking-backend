<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengangkutan extends Model
{
    use HasFactory;

    protected $fillable = [
        'perusahaan_id',
        'kendaraan_id',
        'tanggal',
        'jenis_limbah',
        'tujuan',
        'status',
    ];

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class);
    }

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }
}
