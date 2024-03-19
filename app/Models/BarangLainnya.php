<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangLainnya extends Model
{
    use HasFactory;

    protected $fillables = [
        'data_pengaju_id',
        'code_barang',
        'nm_barang',
        'jenis_id',
    ];

    protected $with = ['datapengaju', 'jenis'];

    public function datapengaju(){
        return $this->belongsTo(Datapengaju::class, 'data_pengaju_id');
    }

    public function jenis(){
        return $this->belongsTo(Jenisbarang::class, 'jenis_id');
    }
}
