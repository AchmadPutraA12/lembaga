<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $organizations = [
            [
                'org_nama' => 'Lembaga Layanan Pendidikan Tinggi Wilayah VII',
                'org_nama_singkat' => 'LLDIKTI VII',
                'org_kode' => '000001',
                'org_email' => 'ult.lldikti7@kemdikbud.go.id',
                'org_telp' => '0315925419',
                'org_kota' => 'Surabaya',
                'org_alamat' => 'Jl. Dr. Ir. H. Soekarno No.177, Klampis Ngasem, Kec. Sukolilo, Kota SBY, Jawa Timur 60117',
                'org_website' => 'https://lldikti7.kemdikbud.go.id/',
                'org_logo' => 'test.png',
                'org_status' => 'Aktif',
                'org_defined_id' => 'QrnhEoXFt402Bx5n',
                'id_organization_type' => 1,
                // 'id_user' => $id_user
            ]
        ];
        DB::table('organizations')->insert($organizations);
    }
}
