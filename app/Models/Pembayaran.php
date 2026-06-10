<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_reservasi',
        'reservasi_id',
        'jenis_pembayaran',
        'jumlah_bayar',
        'status_pembayaran',
        'bukti_transfer'
    ];

    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class);
    }
}