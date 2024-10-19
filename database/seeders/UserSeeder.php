<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    protected static ?string $password;

    public function run(): void
    {
        
        $super_admin = User::create([
            'name' => 'super_admin',
            'nip' => '200301102025011001',
            'email' => 'wsobirin2@gmail.com',
            'password' => static::$password ??= Hash::make('password'),
            'is_active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'id_organization_type' => 1,
            'id_organization' => 'QrnhEoXFt402Bx5n', 
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $super_admin->assignRole('super_admin');
    }
}
