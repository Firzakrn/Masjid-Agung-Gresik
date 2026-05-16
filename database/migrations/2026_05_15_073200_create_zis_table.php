<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('zis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pemberi');
            $table->string('jenis_dana');
            $table->integer('jumlah_orang')->default(1);
            $table->bigInteger('jumlah_dana');
            $table->text('keterangan')->nullable();
            $table->string('bukti_transfer');
            $table->enum('status', ['pending', 'disetujui', 'ditolak'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zis');
    }
};
