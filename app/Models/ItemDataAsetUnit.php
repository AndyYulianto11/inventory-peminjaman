<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemDataAsetUnit extends Model
{
    use HasFactory;

    protected $fillable = [
        'dataasetunit_id',
        'barang_id',
        'qty'
    ];

    protected $with = ['dataasetunit', 'barang'];

    public function dataasetunit()
    {
        return $this->belongsTo(DataAsetUnit::class, 'dataasetunit_id');
    }

    public function barang()
    {
        return $this->belongsTo(Databarang::class, 'barang_id');
    }
}
