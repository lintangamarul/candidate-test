<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BuildingPartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('building_parts')->insert([
            [
                'id' => 3,
                'project_id' => 3,
                'name' => 'Walls',
                'building_part_type_id' => 2,
                'material_id' => 1,
                'supplier_id' => 3,
                'created_at' => '2025-06-09 06:46:57',
                'updated_at' => '2025-06-09 06:47:06',
            ],
            [
                'id' => 4,
                'project_id' => 3,
                'name' => 'Front Beam',
                'building_part_type_id' => 3,
                'material_id' => 1,
                'supplier_id' => 1,
                'created_at' => '2025-06-09 06:47:30',
                'updated_at' => '2025-06-09 06:47:30',
            ],
            [
                'id' => 5,
                'project_id' => 3,
                'name' => 'Floors of Living Room',
                'building_part_type_id' => 1,
                'material_id' => 2,
                'supplier_id' => 5,
                'created_at' => '2025-06-09 06:48:02',
                'updated_at' => '2025-06-09 06:48:02',
            ],
            [
                'id' => 6,
                'project_id' => 3,
                'name' => 'Rear Column',
                'building_part_type_id' => 6,
                'material_id' => 1,
                'supplier_id' => 2,
                'created_at' => '2025-06-09 06:48:39',
                'updated_at' => '2025-06-09 06:48:39',
            ],
            [
                'id' => 7,
                'project_id' => 4,
                'name' => 'Floor Square',
                'building_part_type_id' => 1,
                'material_id' => 1,
                'supplier_id' => 5,
                'created_at' => '2025-06-09 06:50:53',
                'updated_at' => '2025-06-09 06:50:53',
            ],
            [
                'id' => 8,
                'project_id' => 4,
                'name' => 'Column Beside Room',
                'building_part_type_id' => 6,
                'material_id' => 2,
                'supplier_id' => 2,
                'created_at' => '2025-06-09 06:51:23',
                'updated_at' => '2025-06-09 06:51:23',
            ],
            [
                'id' => 9,
                'project_id' => 4,
                'name' => 'Wall Climbing',
                'building_part_type_id' => 2,
                'material_id' => 1,
                'supplier_id' => 3,
                'created_at' => '2025-06-09 06:51:44',
                'updated_at' => '2025-06-09 06:51:44',
            ],
            [
                'id' => 10,
                'project_id' => 4,
                'name' => 'Beam Rear',
                'building_part_type_id' => 3,
                'material_id' => 2,
                'supplier_id' => 4,
                'created_at' => '2025-06-09 06:52:04',
                'updated_at' => '2025-06-09 06:52:04',
            ],
            [
                'id' => 11,
                'project_id' => 5,
                'name' => 'Brick Wall',
                'building_part_type_id' => 2,
                'material_id' => 1,
                'supplier_id' => 5,
                'created_at' => '2025-06-09 06:54:23',
                'updated_at' => '2025-06-09 06:54:23',
            ],
            [
                'id' => 12,
                'project_id' => 5,
                'name' => 'Column Front',
                'building_part_type_id' => 6,
                'material_id' => 2,
                'supplier_id' => 4,
                'created_at' => '2025-06-09 06:54:43',
                'updated_at' => '2025-06-09 06:54:43',
            ],
            [
                'id' => 13,
                'project_id' => 5,
                'name' => 'Marble Floor',
                'building_part_type_id' => 1,
                'material_id' => 1,
                'supplier_id' => 3,
                'created_at' => '2025-06-09 06:55:20',
                'updated_at' => '2025-06-09 06:55:20',
            ],
            [
                'id' => 14,
                'project_id' => 5,
                'name' => 'Beam Front',
                'building_part_type_id' => 3,
                'material_id' => 2,
                'supplier_id' => 2,
                'created_at' => '2025-06-09 06:55:56',
                'updated_at' => '2025-06-09 06:55:56',
            ],
        ]);
    }
}