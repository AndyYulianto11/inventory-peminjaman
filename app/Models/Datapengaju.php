<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datapengaju extends Model
{
    use HasFactory;

    protected $fillable = [
        'code_pengajuan',
        'tgl_pengajuan',
        'user_id',
        'status_setujuatasan',
        'status_setujuadmin',
        'status_pengajuan',
        'status_submit',
        'upload_dokumen',
    ];

    protected $with = ['user'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
