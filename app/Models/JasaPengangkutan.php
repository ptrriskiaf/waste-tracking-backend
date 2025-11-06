<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JasaPengangkutan extends Model
{
    use HasFactory;

    protected $table = 'jasa_pengangkutan';

    protected $fillable = [
        'nama_jasa',
        'deskripsi',
    ];

}
