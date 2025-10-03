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
        Schema::create('level_pangans', function (Blueprint $table) {
            $table->unsignedBigInteger('kode_level')->primary();
            $table->string('nama_level');
            $table->unsignedBigInteger('kode_jenis');
            $table->foreign('kode_jenis')->references('kode_jenis')->on('jenis_pangans')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('level_pangans');
    }
};
