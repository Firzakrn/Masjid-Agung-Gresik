<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reservasis', function (Blueprint $table) {
            $table->string('bukti_dp')->nullable()->after('status');
            $table->enum('status_dp', ['menunggu', 'disetujui', 'ditolak'])
                  ->default('menunggu')->after('bukti_dp');
        });
    }

    public function down(): void
    {
        Schema::table('reservasis', function (Blueprint $table) {
            $table->dropColumn(['bukti_dp', 'status_dp']);
        });
    }
};