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
        Schema::create('tb_bidang_tim', function (Blueprint $table) {
            $table->string('id_bidang_tim')->primary();
            $table->string('id_user');
            $table->string('nama_bidang_tim');
            $table->string('deskripsi_bidang_tim');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_bidang_tim');
    }
};
