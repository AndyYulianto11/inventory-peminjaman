<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datapengaju extends Model
{
    use HasFactory;

    protected $fillable = [
        'code_pengajuan', 'tgl_pengajuan', 'user_id', 'status_setujuatasan', 'status_pengajuan', 'upload_dokumen'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function item_datapengaju()
    {
        return $this->hasMany(ItemDataPengaju::class);
    }
}
