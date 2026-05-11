<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    // mengatur apa yg diizinkan untuk diisi
    // $hidden untuk menyembunyikan data yang tidak ingin ditampilkan
    protected $fillable = [
        'judul', 
        'kategori', 
        'sub_kategori', 
        'foto', 
        'isi_konten'
    ];
    // membuat fungsi filter agar memudahkan di controller
    public function scopeKategori($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }

    public function scopeSubKategori($query, $sub)
    {
        return $query->where('sub_kategori', $sub);
    }
}