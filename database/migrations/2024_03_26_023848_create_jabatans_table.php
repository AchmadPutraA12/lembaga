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
        Schema::create('jabatans', function (Blueprint $table) {
            $table->id();
            $table->string('jabatan_nama', 100)->nullable(false)->default('not set');
            $table->enum('jabatan_active_status', ['Aktif', 'Tidak Aktif', 'not set'])->nullable(false)->default('not set');
            $table->enum('jabatan_organisasi', ['perguruan tinggi', 'badan penyelenggara']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jabatans');
    }
};
