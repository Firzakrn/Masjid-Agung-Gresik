<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }
    public function getHargaPaket(): array
    {
        if (stripos($this->paket, 'Intimate Wedding') !== false)
            return ['harga' => 2500000, 'dp' => 1000000];
        if (stripos($this->paket, 'Wedding') !== false)
            return ['harga' => 12500000, 'dp' => 3000000];
        if (stripos($this->paket, 'Akad') !== false)
            return ['harga' => 3000000, 'dp' => 1000000];

        return ['harga' => 7500000, 'dp' => 2000000];
    }
}