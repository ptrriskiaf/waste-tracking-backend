<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    use HasFactory;

    protected $table = 'perusahaan';

    protected $fillable = [
        'nama',
        'alamat',
        'no_izin',
        'kontak',
        'email',
    ];

    public function kendaraan()
    {
        return $this->hasMany(Kendaraan::class);
    }

    public function pengangkutan()
    {
        return $this->hasMany(Pengangkutan::class);
    }
}
