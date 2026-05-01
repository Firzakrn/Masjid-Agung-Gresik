<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;

    // Mengizinkan semua kolom diisi (kecuali id)
    protected $guarded = ['id'];

    // Relasi: 1 Reservasi dimiliki oleh 1 User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}