<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class IngredientTranslationFactory extends Factory
{
    public function definition()
    {
        return [
            'ingredient_id' => fake()->numberBetween(1, 10),
            'title' => fake()->unique()->name(),
        ];
    }
}
