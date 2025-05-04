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
        Schema::create('baju', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang')->unique();
            $table->string('gambar')->nullable();
            $table->string('merek_baju');
            $table->string('ukuran');
            $table->string('bahan_baju');
            $table->decimal('harga_baju', 10, 0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('baju');
    }
};
