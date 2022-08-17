<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryTranslationFactory extends Factory
{
    public function definition()
    {
        return [
            'category_id' => fake()->numberBetween(1, 10),
            'title' => fake()->unique()->name(),
        ];
    }
}
