<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barangmasuk extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_nota',
        'tanggal_pembelian',
        'total_bayar',
        'ppn_angka',
        'ppn_persen',
        'diskon_angka',
        'diskon_persen'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function barang()
    {
        return $this->belongsTo(Databarang::class, 'barang_id');
    }

    public function item_barangmasuk()
    {
        return $this->hasMany(ItemBarangMasuk::class);
    }
}
