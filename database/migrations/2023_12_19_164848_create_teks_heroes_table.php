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
        Schema::create('tb_teks_hero', function (Blueprint $table) {
            $table->string('id_teks_hero')->primary();
            $table->string('id_gambar_hero');
            $table->string('id_user');
            $table->text('judul_teks_hero');
            $table->longText('deskripsi_teks_hero')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_teks_hero');
    }
};
