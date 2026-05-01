<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservasis', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke user yang sedang login
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // Data Acara
            $table->string('paket');
            $table->string('tanggal');
            $table->string('sesi');
            $table->string('status')->default('Menunggu Pembayaran DP');

            // 1. Data Pemohon
            $table->string('nama_pemohon');
            $table->string('alamat_pemohon');
            $table->string('telp_pemohon');

            // 2A. Data CPP (Pria)
            $table->string('nama_cpp')->nullable();
            $table->string('bin_cpp')->nullable();
            $table->string('alamat_cpp')->nullable();
            $table->string('telp_cpp')->nullable();

            // 2B. Data CPW (Wanita)
            $table->string('nama_cpw')->nullable();
            $table->string('binti_cpw')->nullable();
            $table->string('alamat_cpw')->nullable();
            $table->string('telp_cpw')->nullable();

            // 3. Data Wali
            $table->string('nama_wali')->nullable();
            $table->string('alamat_wali')->nullable();
            $table->string('telp_wali')->nullable();
            $table->string('kua_kecamatan')->nullable();

            // Dokumen (Dibuat nullable agar tidak error kalau belum diupload)
            $table->string('surat_rekomendasi')->nullable();
            $table->string('foto_ktp_cpp')->nullable();
            $table->string('foto_ktp_cpw')->nullable();
            $table->string('foto_cpp_3x4')->nullable();
            $table->string('foto_cpw_3x4')->nullable();

            // Data Keuangan & Fasilitas (Opsional untuk nanti)
            $table->integer('total_fasilitas')->default(0);
            $table->integer('grand_total')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservasis');
    }
};