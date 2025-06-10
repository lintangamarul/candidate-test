<?php

namespace Database\Factories;

use App\Models\BuildingPartType;
use App\Models\BuildingPart;
use App\Models\Material;
use App\Models\Project;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

class BuildingPartFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'project_id' => Project::factory(),
            'building_part_type_id' => BuildingPartType::factory(),
            'material_id' => Material::factory(),
            'supplier_id' => Supplier::factory(),
        ];
    }
}