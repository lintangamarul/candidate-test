<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('materials')->insert([
            [
                'id' => 1,
                'name' => 'CLT',
                'description' => 'A modern building material made by gluing layers of wood perpendicularly, creating a strong and lightweight structural panel.',
                'quantity' => 46,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 2,
                'name' => 'GLT',
                'description' => 'A type of engineered wood made by gluing together multiple layers of timber in parallel grain direction.',
                'quantity' => 53,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}