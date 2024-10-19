<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jabatans = [
            [
                'jabatan_nama' => 'Rektor',
                'jabatan_active_status' => 'Aktif',
                'jabatan_organisasi' => 'perguruan tinggi',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jabatan_nama' => 'Wakil Rektor I',
                'jabatan_active_status' => 'Aktif',
                'jabatan_organisasi' => 'perguruan tinggi',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jabatan_nama' => 'Wakil Rektor II',
                'jabatan_active_status' => 'Aktif',
                'jabatan_organisasi' => 'perguruan tinggi',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jabatan_nama' => 'Wakil Rektor III',
                'jabatan_active_status' => 'Aktif',
                'jabatan_organisasi' => 'perguruan tinggi',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        DB::table('jabatans')->insert($jabatans);
    }
}
