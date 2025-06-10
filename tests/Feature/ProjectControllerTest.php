<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->create());
    }

    public function test_it_can_display_projects_index_page()
    {
        $response = $this->get(route('projects.index'));

        $response->assertStatus(200);
        $response->assertViewIs('projects.index');
    }

    public function test_it_can_create_a_project()
    {
        $data = [
            'name' => 'New Project',
            'description' => 'Project Description'
        ];

        $response = $this->post(route('projects.store'), $data);

        $response->assertRedirect(route('projects.index'));
        $this->assertDatabaseHas('projects', $data);
    }

    public function test_it_validates_required_fields_when_creating_project()
    {
        $response = $this->post(route('projects.store'), []);

        $response->assertSessionHasErrors(['name', 'description']);
        $response->assertStatus(302);
    }

    public function test_it_can_update_a_project()
    {
        $project = Project::factory()->create();
        $data = [
            'name' => 'Updated Name',
            'description' => 'Updated Description'
        ];

        $response = $this->put(route('projects.update', $project), $data);

        $response->assertRedirect(route('projects.index'));
        $this->assertDatabaseHas('projects', $data);
    }

    public function test_it_can_delete_a_project()
    {
        $project = Project::factory()->create();

        $response = $this->delete(route('projects.destroy', $project));

        $response->assertRedirect(route('projects.index'));
        $this->assertDatabaseMissing('projects', ['id' => $project->id]);
    }
}