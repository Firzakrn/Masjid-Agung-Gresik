<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul', 
        'kategori', 
        'sub_kategori', 
        'foto', 
        'isi_konten'
    ];
     // 🔥 Scope untuk filter kategori
    public function scopeKategori($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }

    // 🔥 Scope untuk filter sub kategori
    public function scopeSubKategori($query, $sub)
    {
        return $query->where('sub_kategori', $sub);
    }
}