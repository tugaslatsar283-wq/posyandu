<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('gizis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('desa_id')->constrained('desas')->onDelete('cascade');
            $table->integer('jumlah_balita_normal');
            $table->integer('jumlah_balita_wasting');
            $table->integer('jumlah_balita_stunting');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gizis');
    }
};
