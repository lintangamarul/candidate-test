<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('projects')->insert([
            [
                'id' => 3,
                'user_id' => 2,
                'name' => "Lintang's House",
                'description' => "Build Lintang's House in Semarang City",
                'created_at' => '2025-06-09 06:46:27',
                'updated_at' => '2025-06-09 06:46:27',
            ],
            [
                'id' => 4,
                'user_id' => 2,
                'name' => 'Building an Apartement',
                'description' => 'Building a magnificent apartment in ungaran district',
                'created_at' => '2025-06-09 06:50:21',
                'updated_at' => '2025-06-09 06:50:21',
            ],
            [
                'id' => 5,
                'user_id' => 2,
                'name' => 'Housing Renovation',
                'description' => 'Project to renovate existing public housing in Pedurungan as subsidized housing.',
                'created_at' => '2025-06-09 06:53:45',
                'updated_at' => '2025-06-09 06:53:45',
            ],
        ]);
    }
}
