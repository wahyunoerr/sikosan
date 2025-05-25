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
        Schema::create('tbl_pindah', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_id');
            $table->unsignedBigInteger('kamar_lama_id');
            $table->date('tanggal_pindah');
            $table->string('alasan')->nullable();
            $table->timestamps();

            $table->foreign('booking_id')->references('id')->on('tbl_booking')->onDelete('cascade');
            $table->foreign('kamar_lama_id')->references('id')->on('tbl_kamar')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_pindah');
    }
};
