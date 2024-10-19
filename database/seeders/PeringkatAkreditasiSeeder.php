<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PeringkatAkreditasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $peringkat_akerditasis = [
            [
                'peringkat_nama' => "Terakreditasi A",
                'peringkat_akreditasi_active_status' => "Aktif",
                'peringkat_logo' => 'A.png'
            ],
            [
                'peringkat_nama' => "Terakreditasi B",
                'peringkat_akreditasi_active_status' => "Aktif",
                'peringkat_logo' => 'B.png'
            ],
            [
                'peringkat_nama' => "Terakreditasi Baik Sekali",
                'peringkat_akreditasi_active_status' => "Aktif",
                'peringkat_logo' => 'baik_sekali.png'
            ],
            [
                'peringkat_nama' => "Terakreditasi C",
                'peringkat_akreditasi_active_status' => "Aktif",
                'peringkat_logo' => 'C.png'
            ],
            
        ];

        DB::table('peringkat_akreditasis')->insert($peringkat_akerditasis);

    }
}
