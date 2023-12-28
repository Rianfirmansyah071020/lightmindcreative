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
        Schema::create('tb_card_pelayanan', function (Blueprint $table) {
            $table->string('id_card_pelayanan')->primary();
            $table->string('id_user');
            $table->string('id_pelayanan');
            $table->text('file_gambar_card_pelayanan');
            $table->text('judul_card_pelayanan');
            $table->text('deskripsi_judul_card_pelayanan')->nullable();
            $table->longText('deskripsi_card_pelayanan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_card_pelayanan');
    }
};
