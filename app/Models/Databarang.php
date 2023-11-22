<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Databarang extends Model
{
    use HasFactory;

    protected $fillable = [
        'code_barang', 'nama_barang', 'jenis_id', 'stok', 'satuan_id', 'harga'
    ];

    public function jenisbarang()
    {
        return $this->belongsTo(Jenisbarang::class, 'jenis_id');
    }

    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'satuan_id');
    }

    public function barangmasuks()
    {
        return $this->hasMany(Barangmasuk::class);
    }

    public function datapengajus()
    {
        return $this->hasMany(Datapengaju::class);
    }

    public function dataasetunits()
    {
        return $this->hasMany(DataAsetUnit::class);
    }

    public function historystokbarangs()
    {
        return $this->hasMany(HistoryStokBarang::class);
    }
}
