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
        Schema::create('kamars', function (Blueprint $table) {
            $table->id();
            $table->string('nomor', 100);
            $table->string('harga', 100);
            $table->enum('lantai', ['Lantai 1', 'Lantai 2']);
            $table->enum('status', ['tersedia', 'tidak tersedia']);
            $table->string('foto_kamar', 100);
            $table->string('fasilitas', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kamars');
    }
};
