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
        Schema::create('tb_pelayanan', function (Blueprint $table) {
            $table->string('id_pelayanan')->primary();
            $table->string('id_user');
            $table->text('judul_pelayanan');
            $table->text('deskripsi_judul_pelayanan');
            $table->integer('status_pelayanan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_pelayanan');
    }
};
