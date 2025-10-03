<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GiziMeiSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('gizi')->insert([
            [
                'desa_id' => 1,
                'jumlah_balita_normal' => 130,
                'jumlah_balita_wasting' => 0,
                'jumlah_balita_stunting' => 2,
                'created_at' => Carbon::create(2025, 7, 1),
                'updated_at' => now(),
            ],
            [
                'desa_id' => 2,
                'jumlah_balita_normal' => 128,
                'jumlah_balita_wasting' => 0,
                'jumlah_balita_stunting' => 1,
                'created_at' => Carbon::create(2025, 7, 1),
                'updated_at' => now(),
            ],
            [
                'desa_id' => 3,
                'jumlah_balita_normal' => 135,
                'jumlah_balita_wasting' => 1,
                'jumlah_balita_stunting' => 2,
                'created_at' => Carbon::create(2025, 7, 1),
                'updated_at' => now(),
            ],
            [
                'desa_id' => 4,
                'jumlah_balita_normal' => 140,
                'jumlah_balita_wasting' => 0,
                'jumlah_balita_stunting' => 0,
                'created_at' => Carbon::create(2025, 7, 1),
                'updated_at' => now(),
            ],
            [
                'desa_id' => 5,
                'jumlah_balita_normal' => 132,
                'jumlah_balita_wasting' => 0,
                'jumlah_balita_stunting' => 1,
                'created_at' => Carbon::create(2025, 7, 1),
                'updated_at' => now(),
            ],
            [
                'desa_id' => 6,
                'jumlah_balita_normal' => 160,
                'jumlah_balita_wasting' => 0,
                'jumlah_balita_stunting' => 2,
                'created_at' => Carbon::create(2025, 7, 1),
                'updated_at' => now(),
            ],
            [
                'desa_id' => 7,
                'jumlah_balita_normal' => 136,
                'jumlah_balita_wasting' => 0,
                'jumlah_balita_stunting' => 1,
                'created_at' => Carbon::create(2025, 7, 1),
                'updated_at' => now(),
            ],
            [
                'desa_id' => 8,
                'jumlah_balita_normal' => 160,
                'jumlah_balita_wasting' => 0,
                'jumlah_balita_stunting' => 2,
                'created_at' => Carbon::create(2025, 7, 1),
                'updated_at' => now(),
            ],
            [
                'desa_id' => 9,
                'jumlah_balita_normal' => 140,
                'jumlah_balita_wasting' => 0,
                'jumlah_balita_stunting' => 1,
                'created_at' => Carbon::create(2025, 7, 1),
                'updated_at' => now(),
            ],
            [
                'desa_id' => 10,
                'jumlah_balita_normal' => 145,
                'jumlah_balita_wasting' => 0,
                'jumlah_balita_stunting' => 1,
                'created_at' => Carbon::create(2025, 7, 1),
                'updated_at' => now(),
            ],
            [
                'desa_id' => 11,
                'jumlah_balita_normal' => 155,
                'jumlah_balita_wasting' => 0,
                'jumlah_balita_stunting' => 1,
                'created_at' => Carbon::create(2025, 7, 1),
                'updated_at' => now(),
            ],
        ]);
    }
}