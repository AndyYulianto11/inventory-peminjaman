<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenisbarang extends Model
{
    use HasFactory;

    protected $table = 'jenisbarang';
    protected $fillable = [
        'jenisbarang',
    ];

    public function databarangs()
    {
        return $this->hasMany(Databarang::class);
    }
}
