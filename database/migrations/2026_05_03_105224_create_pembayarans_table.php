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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_reservasi'); // Format: 20260503-RSV-1
            $table->foreignId('reservasi_id')->constrained('reservasis')->onDelete('cascade');
            $table->string('jenis_pembayaran'); // "DP" atau "Pelunasan"
            $table->decimal('jumlah_bayar', 15, 2);
            $table->string('status_pembayaran')->default('menunggu_konfirmasi'); // menunggu_konfirmasi, lunas, gagal
            $table->string('bukti_transfer')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
