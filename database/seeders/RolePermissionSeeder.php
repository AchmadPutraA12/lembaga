<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            //User Mangement
            'edit_own_profile',
            'access_user_management',

            'access_role_permission',
            'create_role_permission',
            'show_role_permission',
            'edit_role_permission',
            

            'access_user',
            'create_user',
            'show_user',
            'edit_user',

            //badan penyelenggara
            'access_data_badan_penyelenggara',
            'create_data_badan_penyelenggara',
            'show_data_badan_penyelenggara',
            'edit_data_badan_penyelenggara',

            'access_perkara_badan_penyelenggara',
            'create_perkara_badan_penyelenggara',
            'show_perkara_badan_penyelenggara',
            'edit_perkara_badan_penyelenggara',

            'view_all_badan_penyelenggara',
            'view_restrict_badan_penyelenggara',

            //Perguruan tinggi
            'access_data_perguruan_tinggi',
            'create_data_perguruan_tinggi',
            'show_data_perguruan_tinggi',
            'edit_data_perguruan_tinggi',

            'access_perkara_perguruan_tinggi',
            'create_perkara_perguruan_tinggi',
            'show_perkara_perguruan_tinggi',
            'edit_perkara_perguruan_tinggi',
            
            'view_all_perguruan_tinggi',
            'view_restrict_perguruan_tinggi',

            //Pimpinan Perguruan Tinggi
            'access_pimpinan_perguruan_tinggi',
            'create_pimpinan_perguruan_tinggi',
            'show_history_perguruan_tinggi',
            'edit_pimpinan_perguruan_tinggi',

            //master
            'access_data_master',

            // peringkat akreditasi
            'access_data_peringkat_akreditasi',
            'create_data_peringkat_akreditasi',
            'show_data_peringkat_akreditasi',
            'edit_data_peringkat_akreditasi',

            //lembag akreditasi
            'access_data_lembaga_akreditasi',
            'create_data_lembaga_akreditasi',
            'show_data_lembaga_akreditasi',
            'edit_data_lembaga_akreditasi',

            //jabatan

            'access_data_jabatan',
            'create_data_jabatan',
            'show_data_jabatan',
            'edit_data_jabatan',

            //program-studi
            'access_data_program_studi', 
            'create_data_program_studi',     
            'show_data_program_studi',     
            'edit_data_program_studi',     

        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission
            ]);
        }

        $role = Role::create([
            'name' => 'super_admin'
        ]);

        $role->givePermissionTo($permissions);
    }
}
