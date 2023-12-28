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
        Schema::create('tb_sosial_media_tim', function (Blueprint $table) {
            $table->string('id_sosial_media_tim')->primary();
            $table->string('id_user');
            $table->string('nama_sosial_media_tim');
            $table->text('link_sosial_media_tim')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_sosial_media_tim');
    }
};
