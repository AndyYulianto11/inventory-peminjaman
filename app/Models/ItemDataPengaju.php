<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemDataPengaju extends Model
{
    use HasFactory;

    protected $fillable = [
        'datapengaju_id',
        'barang_id',
        'qty',
        'status_persetujuanatasan',
        'status_persetujuanadmin',
        'keterangan',
    ];

    public function datapengaju()
    {
        return $this->belongsTo(Datapengaju::class, 'datapengaju_id');
    }

    public function barang()
    {
        return $this->belongsTo(Databarang::class, 'barang_id');
    }

    public function historystokbarangs()
    {
        return $this->hasMany(HistoryStokBarang::class);
    }
}
