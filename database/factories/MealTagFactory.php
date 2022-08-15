<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MealTagFactory extends Factory
{
    public function definition()
    {
        return [
            'meal_id' => fake()->numberBetween(1, 10),
            'tag_id' => fake()->numberBetween(1, 10),
        ];
    }
}
