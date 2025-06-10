<?php

namespace Tests\Unit;

use App\Models\Material;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MaterialTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_validates_name_is_required()
    {
        $material = Material::factory()->make(['name' => null]);
        
        $validator = Validator::make($material->toArray(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'quantity' => 'required|integer|min:0',
        ]);

        $this->assertFalse($validator->passes());
        $this->assertTrue($validator->errors()->has('name'));
    }

    /** @test */
    public function it_validates_quantity_is_positive_integer()
    {
        $material = Material::factory()->make(['quantity' => -1]);
        
        $validator = Validator::make($material->toArray(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'quantity' => 'required|integer|min:0',
        ]);

        $this->assertFalse($validator->passes());
        $this->assertTrue($validator->errors()->has('quantity'));
    }
}