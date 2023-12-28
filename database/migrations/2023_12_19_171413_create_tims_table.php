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
        Schema::create('tb_tim', function (Blueprint $table) {
            $table->string('id_tim')->primary();
            $table->string('id_user');
            $table->string('id_bidang_tim');
            $table->string('nama_tim');
            $table->enum('jenis_kelamin_tim', ['L', 'P'])->default('L');
            $table->text('alamat_tim');
            $table->string('nomor_hp_tim');
            $table->integer('status_tim');
            $table->string('file_gambar_tim');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_tim');
    }
};