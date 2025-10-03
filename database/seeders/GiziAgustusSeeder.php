<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GiziAgustusSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('gizi')->insert([
            [
                'desa_id' => 1,
                'jumlah_balita_normal' => 135,
                'jumlah_balita_wasting' => 0,
                'jumlah_balita_stunting' => 1,
                'created_at' => Carbon::create(2025, 8, 1),
                'updated_at' => now(),
            ],
            [
                'desa_id' => 2,
                'jumlah_balita_normal' => 140,
                'jumlah_balita_wasting' => 0,
                'jumlah_balita_stunting' => 2,
                'created_at' => Carbon::create(2025, 8, 1),
                'updated_at' => now(),
            ],
            [
                'desa_id' => 3,
                'jumlah_balita_normal' => 145,
                'jumlah_balita_wasting' => 0,
                'jumlah_balita_stunting' => 4,
                'created_at' => Carbon::create(2025, 8, 1),
                'updated_at' => now(),
            ],
            [
                'desa_id' => 4,
                'jumlah_balita_normal' => 138,
                'jumlah_balita_wasting' => 0,
                'jumlah_balita_stunting' => 1,
                'created_at' => Carbon::create(2025, 8, 1),
                'updated_at' => now(),
            ],
            [
                'desa_id' => 5,
                'jumlah_balita_normal' => 142,
                'jumlah_balita_wasting' => 0,
                'jumlah_balita_stunting' => 1,
                'created_at' => Carbon::create(2025, 8, 1),
                'updated_at' => now(),
            ],
            [
                'desa_id' => 6,
                'jumlah_balita_normal' => 150,
                'jumlah_balita_wasting' => 0,
                'jumlah_balita_stunting' => 0,
                'created_at' => Carbon::create(2025, 8, 1),
                'updated_at' => now(),
            ],
            [
                'desa_id' => 7,
                'jumlah_balita_normal' => 133,
                'jumlah_balita_wasting' => 0,
                'jumlah_balita_stunting' => 1,
                'created_at' => Carbon::create(2025, 8, 1),
                'updated_at' => now(),
            ],
            [
                'desa_id' => 8,
                'jumlah_balita_normal' => 137,
                'jumlah_balita_wasting' => 0,
                'jumlah_balita_stunting' => 3,
                'created_at' => Carbon::create(2025, 8, 1),
                'updated_at' => now(),
            ],
            [
                'desa_id' => 9,
                'jumlah_balita_normal' => 141,
                'jumlah_balita_wasting' => 0,
                'jumlah_balita_stunting' => 4,
                'created_at' => Carbon::create(2025, 8, 1),
                'updated_at' => now(),
            ],
            [
                'desa_id' => 10,
                'jumlah_balita_normal' => 136,
                'jumlah_balita_wasting' => 0,
                'jumlah_balita_stunting' => 2,
                'created_at' => Carbon::create(2025, 8, 1),
                'updated_at' => now(),
            ],
            [
                'desa_id' => 11,
                'jumlah_balita_normal' => 148,
                'jumlah_balita_wasting' => 0,
                'jumlah_balita_stunting' => 1,
                'created_at' => Carbon::create(2025, 8, 1),
                'updated_at' => now(),
            ],
        ]);
    }
}
