<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gizi;
use Carbon\Carbon;

class GiziSeeder1 extends Seeder
{
    public function run(): void
    {
        
        $desaId = 1; // Desa Ciapus
        $startDate = Carbon::create(2025, 5, 1); // Mei 2025
        $endDate   = Carbon::create(2025, 8, 1); // Agustus 2025

        $date = $startDate;

        while ($date->lte($endDate)) {
            Gizi::create([
                'desa_id' => $desaId,
                'jumlah_balita_normal'   => rand(30, 60),
                'jumlah_balita_wasting'  => rand(2, 3),
                'jumlah_balita_stunting' => rand(2, 2),
                'created_at' => $date->copy()->endOfMonth(),
                'updated_at' => now(),
            ]);

            $date->addMonth();
        }
    }
}
