<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posyandus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('desa_id')->constrained('desas')->onDelete('cascade');
            $table->integer('jumlah_posyandu')->default(0);
            $table->integer('jumlah_balita')->default(0);
            $table->integer('jumlah_balita_normal')->default(0);
            $table->integer('jumlah_balita_stunting')->default(0);
            $table->integer('jumlah_balita_wasting')->default(0);
            $table->integer('jumlah_kader')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posyandus');
    }
};
