<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MealFactory extends Factory
{
    public function definition()
    {
        return [
            'status' => 'created',
            'category_id' => fake()->optional(0.9, null)->numberBetween(1, 10), // 10% chance of null
        ];
    }
}
