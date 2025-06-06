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
        Schema::create('tbl_booking', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('kamar_id');
            $table->string('dp', 100);
            $table->string('bukti_dp');
            $table->string('harga_kamar_booking', 100);
            $table->date('tanggal_booking');
            $table->date('tanggal_checkin')->nullable();
            $table->date('tanggal_checkout')->nullable();
            $table->string('lama_sewa', 100);
            $table->enum('status', ['Menunggu', 'Disetujui', 'Ditolak'])->default('Menunggu');
            $table->string('keterangan', 100)->nullable();
            $table->boolean('is_paid')->default(false);
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('kamar_id')->references('id')->on('tbl_kamar')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_booking');
    }
};
