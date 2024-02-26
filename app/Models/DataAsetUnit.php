<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataAsetUnit extends Model
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

    protected $with = ['user', 'item_dataasetunit'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
