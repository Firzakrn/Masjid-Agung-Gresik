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
}