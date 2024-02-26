<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemDataPengadaanBarang extends Model
{
    use HasFactory;

    protected $fillable = [
        'barang_id',
        'qty',
        'status'
    ];

    protected $with = ['barang', 'satuan'];

    public function barang()
    {
        return $this->belongsTo(Databarang::class, 'barang_id');
    }

    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'satuan_id', 'id');
    }
}
