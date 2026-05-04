<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservasi_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('kategori_id')->nullable()->constrained('kategori_keuangans')->nullOnDelete();
            $table->string('sumber')->default('manual');
            $table->enum('jenis', ['pemasukan', 'pengeluaran']);
            $table->string('keterangan');
            $table->bigInteger('nominal');
            $table->date('tanggal');
            $table->string('bukti_bayar')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};