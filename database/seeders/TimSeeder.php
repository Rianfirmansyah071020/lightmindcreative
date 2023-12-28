<?php

namespace Database\Seeders;

use App\Models\Tim;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TimSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Tim::create([
            'id_tim' => Tim::GenerateID(),
            'id_user' => 1,
            'id_bidang_tim' => 1,
            'nama_tim' => 'Rian',
            'jenis_kelamin_tim' => 'L',
            'alamat_tim' => 'Jl. Cempaka Putih',
            'nomor_hp_tim' => '081234567890',
            'status_tim' => 1,
            'file_gambar_tim' => 'default.png',

        ]);
    }
}