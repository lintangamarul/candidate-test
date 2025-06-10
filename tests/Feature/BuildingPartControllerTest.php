<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\BuildingPart;
use App\Models\BuildingPartType;
use App\Models\Material;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BuildingPartControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->create());
    }

    public function test_it_can_display_building_parts_index_page()
    {
        $project = Project::factory()->create();
        $response = $this->get(route('projects.building-parts.index', $project));

        $response->assertStatus(200);
        $response->assertViewIs('building-parts.index');
    }

    public function test_it_can_create_a_building_part()
    {
        $project = Project::factory()->create();
        $type = BuildingPartType::factory()->create();
        $material = Material::factory()->create();
        $supplier = Supplier::factory()->create();

        $data = [
            'name' => 'New Building Part',
            'building_part_type_id' => $type->id,
            'material_id' => $material->id,
            'supplier_id' => $supplier->id,
        ];

        $response = $this->post(route('projects.building-parts.store', $project), $data);

        $response->assertRedirect(route('projects.building-parts.index', $project));
        $this->assertDatabaseHas('building_parts', array_merge($data, ['project_id' => $project->id]));
    }

    public function test_it_validates_required_fields_when_creating_building_part()
    {
        $project = Project::factory()->create();
        $response = $this->post(route('projects.building-parts.store', $project), []);

        $response->assertSessionHasErrors(['name', 'building_part_type_id', 'material_id', 'supplier_id']);
        $response->assertStatus(302);
    }

    public function test_it_can_update_a_building_part()
    {
        $project = Project::factory()->create();
        $buildingPart = BuildingPart::factory()->create(['project_id' => $project->id]);
        $type = BuildingPartType::factory()->create();
        $material = Material::factory()->create();
        $supplier = Supplier::factory()->create();

        $data = [
            'name' => 'Updated Building Part',
            'building_part_type_id' => $type->id,
            'material_id' => $material->id,
            'supplier_id' => $supplier->id,
        ];

        $response = $this->put(route('projects.building-parts.update', [$project, $buildingPart]), $data);

        $response->assertRedirect(route('projects.building-parts.index', $project));
        $this->assertDatabaseHas('building_parts', array_merge($data, ['id' => $buildingPart->id]));
    }

    public function test_it_can_delete_a_building_part()
    {
        $project = Project::factory()->create();
        $buildingPart = BuildingPart::factory()->create(['project_id' => $project->id]);

        $response = $this->delete(route('projects.building-parts.destroy', [$project, $buildingPart]));

        $response->assertRedirect(route('projects.building-parts.index', $project));
        $this->assertDatabaseMissing('building_parts', ['id' => $buildingPart->id]);
    }
}