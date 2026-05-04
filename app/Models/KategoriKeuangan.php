<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriKeuangan extends Model
{
    protected $fillable = ['nama', 'jenis'];

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'kategori_id');
    }
}