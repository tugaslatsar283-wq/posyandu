<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('keterangan_balita', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('gizi_id');   // relasi ke tabel gizi
    $table->unsignedBigInteger('desa_id');
    $table->string('nama_balita');
    $table->integer('usia');
    $table->text('alamat');
    $table->string('status');
    $table->timestamps();

    $table->foreign('gizi_id')->references('id')->on('gizi')->onDelete('cascade');
    $table->foreign('desa_id')->references('id')->on('desa')->onDelete('cascade');
});
    }

    public function down(): void
    {
        Schema::dropIfExists('keterangan_balita');
    }
};

