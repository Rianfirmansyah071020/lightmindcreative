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
        Schema::create('tb_tentang', function (Blueprint $table) {
            $table->string('id_string')->primary();
            $table->string('id_user');
            $table->text('judul_tentang');
            $table->longText('deskripsi_judul_tentang')->nullable();
            $table->longText('deskripsi_tentang')->nullable();
            $table->integer('status_tentang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_tentang');
    }
};
