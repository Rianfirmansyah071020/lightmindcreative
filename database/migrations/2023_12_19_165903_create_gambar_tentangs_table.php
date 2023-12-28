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
        Schema::create('tb_gambar_tentang', function (Blueprint $table) {
            $table->string('id_gambar_tentang')->primary();
            $table->string('id_user');
            $table->string('id_tentang');
            $table->text('file_gambar_tentang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_gambar_tentang');
    }
};
