<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Gizi;
use Carbon\Carbon;   // <-- tambahkan ini

class GiziSeeder2 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $desaId = 3; // Desa Ciapus
        $startDate = Carbon::create(2025, 5, 1); // Mei 2025
        $endDate   = Carbon::create(2025, 8, 1); // Agustus 2025

        $date = $startDate;

        while ($date->lte($endDate)) {
            Gizi::create([
                'desa_id' => $desaId,
                'jumlah_balita_normal'   => rand(30, 60),
                'jumlah_balita_wasting'  => rand(1, 2),
                'jumlah_balita_stunting' => rand(2, 2),
                'created_at' => $date->copy()->endOfMonth(),
                'updated_at' => now(),
            ]);

            $date->addMonth();
        }
    }
}

