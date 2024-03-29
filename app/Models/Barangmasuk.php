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
        'supplier_id',
        'ppn_angka',
        'ppn_persen',
        'diskon_angka',
        'diskon_persen'
    ];

    protected $with = ['supplier'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
}
