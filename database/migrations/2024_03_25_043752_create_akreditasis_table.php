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
        Schema::create('akreditasis', function (Blueprint $table) {
            $table->id();
            $table->string('akreditasi_sk', 105)->nullable(false)->default('not set');
            $table->date('akreditasi_tgl_awal')->nullable(false)->default('1000-01-01');
            $table->date('akreditasi_tgl_akhir')->nullable(false)->default('1000-01-01');
            $table->enum('akreditasi_status', ['aktif', 'berakhir', 'not set'])->default('not set');
            $table->string('akreditasi_dokumen', 100)->nullable(false)->default('not set');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akreditasis');
    }
};
