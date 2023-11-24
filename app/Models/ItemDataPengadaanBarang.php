<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemDataPengadaanBarang extends Model
{
    use HasFactory;

    protected $fillable = [
        'datapengadaanbarang_id',
        'barang_id',
        'qty'
    ];

    public function datapengadaanbarang()
    {
        return $this->belongsTo(DataPengadaanBarang::class, 'datapengadaanbarang_id');
    }

    public function barang()
    {
        return $this->belongsTo(Databarang::class, 'barang_id');
    }

    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'satuan_id', 'id');
    }
}
