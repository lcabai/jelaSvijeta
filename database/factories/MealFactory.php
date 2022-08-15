<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MealFactory extends Factory
{
    public function definition()
    {
        return [
            'slug' => fake()->unique()->name(),
            'title' => fake()->name(),
            'description' => fake()->text(),
            'status' => 'created',
            'category_id' => fake()->numberBetween(1, 10),
        ];
    }
}
