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
        Schema::create('tb_card_proyek', function (Blueprint $table) {
            $table->string('id_card_proyek')->primary();
            $table->string('id_user');
            $table->string('id_proyek');
            $table->text('file_gambar_card_proyek');
            $table->text('judul_card_proyek');
            $table->longText('deskripsi_judul_card_proyek')->nullable();
            $table->longText('deskripsi_card_proyek')->nullable();
            $table->string('link_card_proyek')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_card_proyek');
    }
};
