<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zis extends Model
{
    protected $table = 'zis';
    protected $fillable = [
        'user_id',
        'nama_pemberi', 'jenis_dana', 'jumlah_orang',
        'jumlah_dana', 'keterangan', 'bukti_transfer', 'status'
    ];
}