<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'reservasi_id',
        'kategori_id',
        'sumber',
        'jenis',
        'keterangan',
        'nominal',
        'tanggal',
        'bukti_bayar',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class);
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriKeuangan::class, 'kategori_id');
    }
}