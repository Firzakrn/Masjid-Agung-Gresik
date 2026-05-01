<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('beritas', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('kategori'); // Isinya: berita atau kegiatan
            $table->string('sub_kategori')->nullable(); // Isinya: agenda, kajian, dll
            $table->string('foto')->nullable(); // Menyimpan nama file gambarnya saja
            $table->text('isi_konten');
            $table->timestamps(); // Otomatis buat kolom created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beritas');
    }
};
