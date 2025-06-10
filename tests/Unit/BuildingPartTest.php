<?php

namespace Tests\Unit;

use App\Models\Project;
use App\Models\BuildingPart;
use App\Models\BuildingPartType;
use App\Models\Material;
use App\Models\Supplier;
use Tests\TestCase;

class BuildingPartTest extends TestCase
{
    /** @test */
    public function it_can_create_a_building_part()
    {
        $project = Project::factory()->create();
        $type = BuildingPartType::factory()->create();
        $material = Material::factory()->create();
        $supplier = Supplier::factory()->create();

        $buildingPart = BuildingPart::create([
            'project_id' => $project->id,
            'name' => 'Test Building Part',
            'building_part_type_id' => $type->id,
            'material_id' => $material->id,
            'supplier_id' => $supplier->id,
        ]);

        $this->assertInstanceOf(BuildingPart::class, $buildingPart);
        $this->assertEquals('Test Building Part', $buildingPart->name);
    }

    /** @test */
    public function it_requires_all_fields()
    {
        $this->expectException(\Illuminate\Database\QueryException::class);
        
        BuildingPart::create([]);
    }

    /** @test */
    public function it_belongs_to_project()
    {
        $project = Project::factory()->create();
        $buildingPart = BuildingPart::factory()->create(['project_id' => $project->id]);

        $this->assertInstanceOf(Project::class, $buildingPart->project);
        $this->assertEquals($project->id, $buildingPart->project->id);
    }
}