<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Meal;
use App\Models\MealIngredient;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Tag::factory(10)->create();
        Category::factory(10)->create();
        Ingredient::factory(10)->create();
        Meal::factory(10)->create();

        TagTranslation::factory(30)->create();
        CategoryTranslation::factory(30)->create();
        IngredientTranslation::factory(30)->create();
        MealTranslation::factory(30)->create();

        MealTag::factory(30)->create();
        MealIngredient::factory(30)->create();
    }
}
