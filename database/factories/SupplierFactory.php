<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SupplierFactory extends Factory
{
    public function definition()
{
    return [
        'name' => $this->faker->company,
        'material_type' => $this->faker->randomElement(['clt', 'glt']),
        'quantity' => $this->faker->numberBetween(1, 100),
    ];
}
}