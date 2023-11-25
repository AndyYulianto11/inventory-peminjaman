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
        'qty'
    ];

    public function barang()
    {
        return $this->belongsTo(Databarang::class, 'barang_id');
    }

    public function transaksipengadaanbarang()
    {
        return $this->belongsTo(TransaksiPengadaanBarang::class, 'transaksipengadaanbarang_id');
    }
}
