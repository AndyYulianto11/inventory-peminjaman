<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datapengaju extends Model
{
    use HasFactory;

    protected $fillable = [
        'code_pengajuan', 'tgl_pengajuan', 'nama_barang', 'jenis_id', 'qty', 'satuan_id'
    ];
}
