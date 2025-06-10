<?php

namespace Tests\Unit;

use App\Models\Project;
use App\Models\BuildingPart;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    /** @test */
    public function it_can_create_a_project()
    {
        $project = Project::factory()->create([
            'name' => 'Test Project',
            'description' => 'Test Description'
        ]);

        $this->assertInstanceOf(Project::class, $project);
        $this->assertEquals('Test Project', $project->name);
        $this->assertEquals('Test Description', $project->description);
    }

    /** @test */
    public function it_requires_name_and_description()
    {
        $this->expectException(\Illuminate\Database\QueryException::class);
        
        Project::create([]);
    }

    /** @test */
    public function it_has_building_parts_relationship()
    {
        $project = Project::factory()
            ->has(BuildingPart::factory()->count(3))
            ->create();

        $this->assertCount(3, $project->buildingParts);
        $this->assertInstanceOf(BuildingPart::class, $project->buildingParts->first());
    }
}