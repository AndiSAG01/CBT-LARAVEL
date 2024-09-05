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
        Schema::create('ujians', function (Blueprint $table) {
            $table->id();
            $table->string('kelas');
            $table->string('tanggal_ujian');
            $table->string('jam_ujian');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('kategori_id');
            $table->unsignedBigInteger('siswa_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('durasi');
            $table->string('status')->nullable();
            $table->string('siswa_names')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ujians');
    }
};
