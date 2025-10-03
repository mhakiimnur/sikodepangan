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
        Schema::create('komoditas_pangans', function (Blueprint $table) {
            $table->unsignedBigInteger('kode_komoditas')->primary();
            $table->string('nama_komoditas');
            $table->unsignedBigInteger('kode_kelompok');
            $table->foreign('kode_kelompok')->references('kode_kelompok')->on('kelompok_pangans')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komoditas_pangans');
    }
};
