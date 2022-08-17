<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TagTranslationFactory extends Factory
{
    public function definition()
    {
        return [
            'tag_id' => fake()->numberBetween(1, 10),
            'title' => fake()->unique()->name(),
        ];
    }
}
