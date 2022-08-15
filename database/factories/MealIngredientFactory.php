<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MealIngredientFactory extends Factory
{
    public function definition()
    {
        return [
            'meal_id' => fake()->numberBetween(1, 10),
            'ingredient_id' => fake()->numberBetween(1, 10),
        ];
    }
}
