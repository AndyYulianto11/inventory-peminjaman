<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $table = 'unit';
    protected $fillable = [
        'kode_unit', 'nama_unit', 'lokasi_unit', 'status_unit',
    ];

}
