<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPengadaanBarang extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_transaksi',
        'nama_transaksi',
        'tgl_transaksi',
        'user_id',
        'status_transaksi',
        'status_pengajuan',
    ];

    protected $with = ['user', 'item_transaksipengadaanbarang'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
