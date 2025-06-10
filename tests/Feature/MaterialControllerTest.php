<?php

namespace Tests\Feature;

use App\Models\Material;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MaterialControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    /** @test */
    public function it_displays_materials_index_page()
    {
        $response = $this->actingAs($this->user)->get(route('materials.index'));
        $response->assertStatus(200);
        $response->assertViewIs('materials.index');
    }

    /** @test */
    public function it_displays_create_material_page()
    {
        $response = $this->actingAs($this->user)->get(route('materials.create'));
        $response->assertStatus(200);
        $response->assertViewIs('materials.create');
    }

    /** @test */
    public function it_stores_new_material()
    {
        $data = [
            'name' => 'New Material',
            'description' => 'Material Description',
            'quantity' => 50
        ];

        $response = $this->actingAs($this->user)
            ->post(route('materials.store'), $data);
            
        $response->assertRedirect(route('materials.index'));
        $this->assertDatabaseHas('materials', $data);
    }

    /** @test */
    public function it_validates_store_request()
    {
        $response = $this->actingAs($this->user)
            ->post(route('materials.store'), []);
            
        $response->assertSessionHasErrors(['name', 'description', 'quantity']);
    }

    /** @test */
    public function it_displays_material_show_page()
    {
        $material = Material::factory()->create();
        $response = $this->actingAs($this->user)
            ->get(route('materials.show', $material));
            
        $response->assertStatus(200);
        $response->assertViewIs('materials.show');
    }

    /** @test */
    public function it_displays_edit_material_page()
    {
        $material = Material::factory()->create();
        $response = $this->actingAs($this->user)
            ->get(route('materials.edit', $material));
            
        $response->assertStatus(200);
        $response->assertViewIs('materials.edit');
    }

    /** @test */
    public function it_updates_material()
    {
        $material = Material::factory()->create();
        $data = [
            'name' => 'Updated Material',
            'description' => 'Updated Description',
            'quantity' => 75
        ];

        $response = $this->actingAs($this->user)
            ->put(route('materials.update', $material), $data);
            
        $response->assertRedirect(route('materials.index'));
        $this->assertDatabaseHas('materials', $data);
    }

    /** @test */
    public function it_deletes_material()
    {
        $material = Material::factory()->create();
        $response = $this->actingAs($this->user)
            ->delete(route('materials.destroy', $material));
            
        $response->assertRedirect(route('materials.index'));
        $this->assertDatabaseMissing('materials', ['id' => $material->id]);
    }

    /** @test */
    public function it_searches_materials()
    {
        $material1 = Material::factory()->create(['name' => 'CLT Panel']);
        $material2 = Material::factory()->create(['name' => 'GLT Beam']);

        $response = $this->actingAs($this->user)
            ->get(route('materials.index', ['search' => 'CLT']));
            
        $response->assertSee('CLT Panel');
        $response->assertDontSee('GLT Beam');
    }
}