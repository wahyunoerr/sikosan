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
        Schema::create('tbl_upload_file_image', function (Blueprint $table) {
            $table->id();
            $table->string('nameImage', 100);
            $table->unsignedBigInteger('kamar_id');
            $table->timestamps();

            $table->foreign('kamar_id')->references('id')->on('tbl_kamar')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_upload_file_image');
    }
};
