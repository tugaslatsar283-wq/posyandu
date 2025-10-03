<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GiziSeptemberSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('gizi')->insert([
            [
                'desa_id' => 1,
                'jumlah_balita_normal' => 145,
                'jumlah_balita_wasting' => 1,
                'jumlah_balita_stunting' => 2,
                'created_at' => Carbon::create(2025, 9, 1),
                'updated_at' => now(),
            ],
            [
                'desa_id' => 2,
                'jumlah_balita_normal' => 150,
                'jumlah_balita_wasting' => 0,
                'jumlah_balita_stunting' => 1,
                'created_at' => Carbon::create(2025, 9, 1),
                'updated_at' => now(),
            ],
            [
                'desa_id' => 3,
                'jumlah_balita_normal' => 152,
                'jumlah_balita_wasting' => 1,
                'jumlah_balita_stunting' => 0,
                'created_at' => Carbon::create(2025, 9, 1),
                'updated_at' => now(),
            ],
            [
                'desa_id' => 4,
                'jumlah_balita_normal' => 147,
                'jumlah_balita_wasting' => 0,
                'jumlah_balita_stunting' => 2,
                'created_at' => Carbon::create(2025, 9, 1),
                'updated_at' => now(),
            ],
            [
                'desa_id' => 5,
                'jumlah_balita_normal' => 149,
                'jumlah_balita_wasting' => 1,
                'jumlah_balita_stunting' => 1,
                'created_at' => Carbon::create(2025, 9, 1),
                'updated_at' => now(),
            ],
            [
                'desa_id' => 6,
                'jumlah_balita_normal' => 155,
                'jumlah_balita_wasting' => 0,
                'jumlah_balita_stunting' => 1,
                'created_at' => Carbon::create(2025, 9, 1),
                'updated_at' => now(),
            ],
            [
                'desa_id' => 7,
                'jumlah_balita_normal' => 143,
                'jumlah_balita_wasting' => 1,
                'jumlah_balita_stunting' => 0,
                'created_at' => Carbon::create(2025, 9, 1),
                'updated_at' => now(),
            ],
            [
                'desa_id' => 8,
                'jumlah_balita_normal' => 146,
                'jumlah_balita_wasting' => 0,
                'jumlah_balita_stunting' => 1,
                'created_at' => Carbon::create(2025, 9, 1),
                'updated_at' => now(),
            ],
            [
                'desa_id' => 9,
                'jumlah_balita_normal' => 151,
                'jumlah_balita_wasting' => 0,
                'jumlah_balita_stunting' => 2,
                'created_at' => Carbon::create(2025, 9, 1),
                'updated_at' => now(),
            ],
            [
                'desa_id' => 10,
                'jumlah_balita_normal' => 148,
                'jumlah_balita_wasting' => 1,
                'jumlah_balita_stunting' => 1,
                'created_at' => Carbon::create(2025, 9, 1),
                'updated_at' => now(),
            ],
            [
                'desa_id' => 11,
                'jumlah_balita_normal' => 153,
                'jumlah_balita_wasting' => 0,
                'jumlah_balita_stunting' => 0,
                'created_at' => Carbon::create(2025, 9, 1),
                'updated_at' => now(),
            ],
        ]);
    }
}
