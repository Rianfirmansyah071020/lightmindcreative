<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'id_user' => 1,
            'kode_user' => 1,
            'id_tim' => 'TIM202312200000001',
            'email' => 'user@gmail.com',
            'password' => Hash::make('user'),
            'level_user' => 1,
            'status_user' => 1,
            'remember_token' => null
        ]);
    }
}
