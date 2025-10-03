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
        Schema::create('jenis_pangans', function (Blueprint $table) {
            $table->unsignedBigInteger('kode_jenis')->primary();
            $table->string('nama_jenis');
            $table->unsignedBigInteger('kode_komoditas');
            $table->foreign('kode_komoditas')->references('kode_komoditas')->on('komoditas_pangans')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_pangans');
    }
};
