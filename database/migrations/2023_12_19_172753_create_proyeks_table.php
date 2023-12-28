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
        Schema::create('tb_proyek', function (Blueprint $table) {
            $table->string('id_proyek')->primary();
            $table->string('id_user');
            $table->text('judul_proyek');
            $table->longText('deskripsi_judul_proyek')->nullable();
            $table->integer('status_proyek');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_proyek');
    }
};
