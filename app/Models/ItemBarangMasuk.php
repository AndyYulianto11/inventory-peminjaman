<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemBarangMasuk extends Model
{
    use HasFactory;

    protected $fillable = [
        'barangmasuk_id',
        'user_id',
        'barang_id',
        'qty',
        'harga',
        'jumlah',
    ];

    protected $with = ['barangmasuk', 'barang'];

    public function barangmasuk()
    {
        return $this->belongsTo(Barangmasuk::class, 'barangmasuk_id');
    }

    public function barang()
    {
        return $this->belongsTo(Databarang::class, 'barang_id');
    }
}
