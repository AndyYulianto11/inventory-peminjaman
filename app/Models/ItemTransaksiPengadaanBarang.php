<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemTransaksiPengadaanBarang extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaksipengadaanbarang_id',
        'barang_id',
        'code_barang',
        'nama_barang',
        'satuan',
        'harga',
        'qty'
    ];

    protected $with = ['barang', 'transaksipengadaanbarang'];

    public function barang()
    {
        return $this->belongsTo(Databarang::class, 'barang_id');
    }

    public function transaksipengadaanbarang()
    {
        return $this->belongsTo(TransaksiPengadaanBarang::class, 'transaksipengadaanbarang_id');
    }
}
