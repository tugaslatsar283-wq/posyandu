<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Desa;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
   public function run()
{
    // Super Admin
    User::create([
        'name' => 'Super Admin',
        'email' => 'superadmin@posyandu.test',
        'password' => Hash::make('password'),
        'role' => 'superadmin',
    ]);

    // Kecamatan (akses setara superadmin)
    User::create([
        'name' => 'Kecamatan Admin',
        'email' => 'kecamatan@posyandu.test',
        'password' => Hash::make('password'),
        'role' => 'kecamatan',
    ]);

    // Admin Desa
    User::create([
        'name' => 'Admin Desa',
        'email' => 'desa@posyandu.test',
        'password' => Hash::make('password'),
        'role' => 'admin',
    ]);

    // Operator Desa
    User::create([
        'name' => 'Operator Desa',
        'email' => 'operator@posyandu.test',
        'password' => Hash::make('password'),
        'role' => 'operator',
    ]);
}
}
