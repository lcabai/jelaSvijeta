<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MealFactory extends Factory
{
    public function definition()
    {
        return [
            'status' => 'created',
            'category_id' => fake()->numberBetween(1, 10),
        ];
    }
}
