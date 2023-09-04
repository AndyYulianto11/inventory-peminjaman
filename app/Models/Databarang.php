<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Databarang extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_barang', 'jenis_id', 'stok', 'satuan_id'
    ];

    public function jenisbarang()
    {
        return $this->belongsTo(Jenisbarang::class, 'jenis_id');
    }

    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'satuan_id');
    }
}
