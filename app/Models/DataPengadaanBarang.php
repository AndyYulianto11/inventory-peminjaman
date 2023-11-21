<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPengadaanBarang extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_transaksi',
        'tgl_transaksi',
        'user_id',
        'yang_menyerahkan',
        'upload_dokumen_serahterima',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function item_datapengadaanbarang()
    {
        return $this->hasMany(ItemDataPengadaanBarang::class);
    }
}
