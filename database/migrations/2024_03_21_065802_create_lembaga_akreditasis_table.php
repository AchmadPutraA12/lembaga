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
        Schema::create('lembaga_akreditasis', function (Blueprint $table) {
            $table->id();
            $table->string('lembaga_nama', 200)->nullable(false)->default('not set');
            $table->string('lembaga_nama_singkat', 50)->nullable(false)->default('not set');
            $table->string('lembaga_logo', 150)->nullable(false)->default('not set');
            $table->enum('lembaga_status', ['Aktif','Tidak Aktif', 'not set'])->nullable(false)->default('not set');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lembaga_akreditasis');
    }
};
