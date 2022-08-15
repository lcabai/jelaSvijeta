<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MealTranslationFactory extends Factory
{
    public function definition()
    {
        return [
            'meal_id' => fake()->numberBetween(1, 10),
            'language_id' => fake()->numberBetween(1, 3),
            'title' => fake()->name(),
            'description' => fake()->text(),
        ];
    }
}
