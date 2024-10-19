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
        Schema::create('program_studis', function (Blueprint $table) {
            $table->id();
            $table->char("prodi_kode", 5)->nullable(false)->unique();
            $table->char("prodi_defined_id", 16)->nullable(false)->unique();
            $table->string('prodi_nama',100)->nullable(false)->default('not set');
            $table->enum('prodi_jenjang', ['D1','D2', 'D3','D4','S1','S2','S3','not set'])->default('not set');
            $table->enum('prodi_active_status', ['Aktif', 'Tidak Aktif', 'not set'])->nullable(false)->default('not set');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_studis');
    }
};
