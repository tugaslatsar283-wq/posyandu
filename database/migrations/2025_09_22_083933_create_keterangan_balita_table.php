<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('keterangan_balita', function (Blueprint $table) {
            $table->id();
            
            // relasi ke gizi
            $table->unsignedBigInteger('gizi_id');
            $table->foreign('gizi_id')->references('id')->on('gizi')->onDelete('cascade');

            // relasi ke desa
            $table->unsignedBigInteger('desa_id');
            $table->foreign('desa_id')->references('id')->on('desa')->onDelete('cascade');

            $table->string('nama_balita');
            $table->integer('usia'); // dalam bulan
            $table->text('alamat');
            $table->enum('status', ['Normal', 'Stunting', 'Wasting'])->default('Normal');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keterangan_balita');
    }
};
