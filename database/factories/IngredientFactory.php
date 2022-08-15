<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class IngredientFactory extends Factory
{
    public function definition()
    {
        return [
            'slug' => fake()->unique()->name(),
        ];
    }
}
