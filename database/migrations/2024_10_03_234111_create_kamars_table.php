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
        Schema::create('tbl_kamar', function (Blueprint $table) {
            $table->id();
            $table->string('nomor', 100);
            $table->string('harga', 100);
            $table->enum('lantai', ['Lantai 1', 'Lantai 2', 'Lantai 3']);
            $table->enum('status', ['Sudah Dihuni', 'Belum Dihuni']);
            $table->string('fasilitas', 100);
            $table->string('alamat', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_kamar');
    }
};
