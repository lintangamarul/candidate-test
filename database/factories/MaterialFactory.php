<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MaterialFactory extends Factory
{
    public function definition()
{
    return [
        'name' => $this->faker->word,
        'description' => $this->faker->sentence,
        'quantity' => $this->faker->numberBetween(1, 100),
    ];
}
}