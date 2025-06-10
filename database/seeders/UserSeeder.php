<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Test User',
                'email' => 'test@example.com',
                'email_verified_at' => '2025-06-09 03:26:33',
                'password' => Hash::make('12345678'),
                'remember_token' => 'OHPugPfGOk',
                'created_at' => '2025-06-09 03:26:34',
                'updated_at' => '2025-06-09 03:26:34',
            ],
            [
                'id' => 2,
                'name' => 'Lintang Amarul Fatah',
                'email' => 'lintangamarull@gmail.com',
                'email_verified_at' => null,
                'password' => Hash::make('12345678'),
                'remember_token' => null,
                'created_at' => '2025-06-09 03:35:28',
                'updated_at' => '2025-06-09 03:35:28',
            ],
        ]);
    }
}
