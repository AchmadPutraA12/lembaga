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
        Schema::create('organizations', function (Blueprint $table) {

            $table->id();
            $table->string('org_nama',100)->nullable(false)->default('not set');
            $table->string("org_nama_singkat", 50)->nullable(false)->default('not set');
            $table->char("org_kode", 6)->nullable(false)->unique();
            $table->char("org_defined_id", 16)->nullable(false)->unique();
            $table->string('org_email', 100)->nullable(false)->default('not set');
            $table->string('org_telp', 20)->nullable(false)->default('not set');
            $table->string('org_kota',45)->nullable(false)->default('not set');
            $table->string('org_alamat', 200)->nullable(false)->default('not set');
            $table->string('org_website', 100)->nullable(false)->default('not set');
            $table->string('org_logo', 200)->nullable(false)->default('not set');
            $table->enum('org_status', ['Aktif','Tidak Aktif', 'Pembinaan','Alih Bentuk','Alih Kelola','Tutup', 'not set'])->default('not set');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};
