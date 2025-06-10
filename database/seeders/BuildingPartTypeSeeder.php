<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BuildingPartTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('building_part_types')->insert([
            [
                'id' => 1,
                'name' => 'Floor',
                'description' => 'The flat surface that forms the bottom of a room or building level.',
                'quantity' => 23,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 2,
                'name' => 'Wall',
                'description' => 'A vertical structure that divides or encloses a space',
                'quantity' => 13,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 3,
                'name' => 'Beam',
                'description' => 'A long, sturdy piece of material (wood, steel, concrete, etc.) used to support loads in buildings or structures.',
                'quantity' => 17,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 6,
                'name' => 'Column',
                'description' => 'A vertical structural element that supports a building or other structure.',
                'quantity' => 27,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}