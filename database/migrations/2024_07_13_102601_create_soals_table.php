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
        Schema::create('soals', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->unsignedBigInteger('kategori_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->longText('soal_ujian');
            $table->longText('kunci_A');
            $table->longText('kunci_B');
            $table->longText('kunci_C');
            $table->longText('kunci_D');
            $table->longText('kunci_E');
            $table->string('kunci_jawaban');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soals');
    }
};
