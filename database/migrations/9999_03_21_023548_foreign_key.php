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
        //events
        // Schema::table('nama_table', function (Blueprint $table) {
        //     $table->tipe_data('nama_kolom', length);

        //     $table->foreign('nama_kolom')->references('kolom_tabel_asal')->on('tabel_asal');
        // });

        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('id_organization_type');
            $table->foreign('id_organization_type')->references('id')->on('organization_types');

            $table->char('id_organization', 16);
            $table->foreign('id_organization')->references('org_defined_id')->on('organizations');
        });

        Schema::table('organizations', function (Blueprint $table) {
            $table->unsignedBigInteger('id_organization_type');
            $table->foreign('id_organization_type')->references('id')->on('organization_types');

            $table->unsignedBigInteger('id_user')->nullable();
            $table->foreign('id_user')->references('id')->on('users');

        });

        Schema::table('aktas', function (Blueprint $table) {
            $table->char('id_organization', 16)->nullable();
            $table->foreign('id_organization')->references('org_defined_id')->on('organizations');

            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');

            $table->char('id_prodi',16)->nullable();
            $table->foreign('id_prodi')->references('prodi_defined_id')->on('program_studis');


        });

        Schema::table('akreditasis', function (Blueprint $table) {
            $table->unsignedBigInteger('id_peringkat_akreditasi');
            $table->foreign('id_peringkat_akreditasi')->references('id')->on('peringkat_akreditasis');

            $table->char('id_organization', 16)->nullable();
            $table->foreign('id_organization')->references('org_defined_id')->on('organizations');

            $table->unsignedBigInteger('id_lembaga_akreditasi');
            $table->foreign('id_lembaga_akreditasi')->references('id')->on('lembaga_akreditasis');

            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');

            $table->char('id_prodi',16)->nullable();
            $table->foreign('id_prodi')->references('prodi_defined_id')->on('program_studis');
        });

        Schema::table('program_studis', function (Blueprint $table) {
            $table->char('id_organization', 16);
            $table->foreign('id_organization')->references('org_defined_id')->on('organizations');

            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');
        });

        Schema::table('pimpinan_organisasis', function (Blueprint $table) {
            $table->unsignedBigInteger('id_jabatan');
            $table->foreign('id_jabatan')->references('id')->on('jabatans');

            $table->char('id_organization', 16);
            $table->foreign('id_organization')->references('org_defined_id')->on('organizations');

        });

        Schema::table('kepemilikans', function(Blueprint $table){
            $table->char('parent_organization_id', 16)->nullable();
            $table->foreign('parent_organization_id')->references('org_defined_id')->on('organizations');

            $table->char('child_organization_id', 16)->nullable();
            $table->foreign('child_organization_id')->references('org_defined_id')->on('organizations');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('program_studis', function (Blueprint $table) {
        //     $table->dropForeign(['fk_perti_guid']);
        //     $table->dropColumn('ifk_perti_guid');
        // });

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['id_organization_type']);
            $table->dropColumn('id_organization_type');

            $table->dropForeign(['id_organization']);
            $table->dropColumn('id_organization');
        });

        Schema::table('organizations', function (Blueprint $table) {
            $table->dropForeign(['id_orgaziation_type']);
            $table->dropColumn('id_orgaziation_type');

            $table->dropForeign(['parent_organization_id']);
            $table->dropColumn('parent_organization_id');

            $table->dropForeign(['id_user']);
            $table->dropColumn('id_user');
        });

        Schema::table('aktas', function (Blueprint $table) {
            $table->dropForeign(['id_organization']);
            $table->dropColumn('id_organization');

            $table->dropForeign(['id_user']);
            $table->dropColumn('id_user');

            $table->dropForeign(['id_prodi']);
            $table->dropColumn('id_prodi');
        });

        Schema::table('akreditasis', function (Blueprint $table) {
            $table->dropForeign(['id_peringkat_akreditasi']);
            $table->dropColumn('id_peringkat_akreditasi');

            $table->dropForeign(['id_organization']);
            $table->dropColumn('id_organization');

            $table->dropForeign(['id_lembaga_akreditasi']);
            $table->dropColumn('id_lembaga');

            $table->dropForeign(['id_user']);
            $table->dropColumn('id_user');

            $table->dropForeign(['id_prodi']);
            $table->dropColumn('id_prodi');
        });

        Schema::table('program_studis', function (Blueprint $table) {
            $table->dropForeign(['id_organization']);
            $table->dropColumn('id_organization');

            $table->dropForeign(['id_user']);
            $table->dropColumn('id_user');
        });

        Schema::table('pimpinan_organisasis', function (Blueprint $table) {
            $table->dropForeign(['id_jabatan']);
            $table->dropColumn('id_jabatan');

            $table->dropForeign(['id_organization']);
            $table->dropColumn('id_organization');
        });

        Schema::table('kepemilikans', function(Blueprint $table){
            $table->dropForeign(['parent_organization_id']);
            $table->dropColumn('parent_organization_id');

            $table->dropForeign(['child_organization_id']);
            $table->dropColumn('child_organization_id');
        });
    }
};
