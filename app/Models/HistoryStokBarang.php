<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryStokBarang extends Model
{
    use HasFactory;

    protected $fillable = [
        'databarang_id',
        'barangmasuk_id', // tambah stok
        'itemdatapengaju_id', // pengurangan stok
        'qty', // stok yg ter record
        'keterangan',
    ];

    protected $with = ['barang', 'barangmasuk', 'itemdatapengaju'];

    public function barang()
    {
        return $this->belongsTo(Databarang::class, 'databarang_id');
    }

    public function barangmasuk()
    {
        return $this->belongsTo(Barangmasuk::class, 'barangmasuk_id');
    }

    public function itemdatapengaju()
    {
        return $this->belongsTo(ItemDataPengaju::class, 'itemdatapengaju_id');
    }
}
