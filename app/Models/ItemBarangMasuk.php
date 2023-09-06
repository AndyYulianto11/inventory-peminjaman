<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemBarangMasuk extends Model
{
    use HasFactory;

    protected $fillable = [
        'barangmasuk_id',
        'supplier_id',
        'user_id',
        'barang_id',
        'qty',
        'harga'
    ];

    public function barangmasuk()
    {
        return $this->belongsTo(Barangmasuk::class, 'barangmasuk_id');
    }
}
