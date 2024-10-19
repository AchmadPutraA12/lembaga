<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrganizationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $organization_types = [
            [
                'organization_type_name' => 'Lembaga Layanan Pendidikan Tinggi Wilayah VII'
            ],
            [
                'organization_type_name' => 'Badan penyelenggara'
            ],
            [
                'organization_type_name' => 'Perguruan Tinggi'
            ]
        ];

        DB::table('organization_types')->insert($organization_types);

    }
}
