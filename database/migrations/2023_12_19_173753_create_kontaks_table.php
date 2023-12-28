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
        Schema::create('tb_kontak', function (Blueprint $table) {
            $table->string('id_kontak')->primary();
            $table->string('id_user');
            $table->string('nomor_hp_kontak');
            $table->string('email_kontak');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_kontak');
    }
};
