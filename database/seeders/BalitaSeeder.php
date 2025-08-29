<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BalitaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    \App\Models\Balita::create([
        'nama' => 'Budi',
        'tanggal_lahir' => '2022-01-10',
        'jenis_kelamin' => 'L',
        'nama_ortu' => 'Pak Andi',
    ]);

    \App\Models\Balita::create([
        'nama' => 'Siti',
        'tanggal_lahir' => '2021-12-05',
        'jenis_kelamin' => 'P',
        'nama_ortu' => 'Bu Rina',
    ]);
}

}
