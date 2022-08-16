<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Meal;
use App\Models\Tag;
use App\Models\CategoryTranslation;
use App\Models\IngredientTranslation;
use App\Models\MealTranslation;
use App\Models\TagTranslation;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            LanguageSeeder::class
        ]);

        Tag::factory(10)->create();
        Category::factory(10)->create();
        Ingredient::factory(100)->create();
        Meal::factory(30)->create()->each(
            function ($meal) {
                $meal->tags()->attach(fake()->unique()->randomElements(range(1, 10), rand(1, 10)));
                $meal->ingredients()->attach(fake()->unique()->randomElements(range(1, 100), rand(1, 10)));
            }
        );

        for ($id = 1; $id <= 10; $id++) {
            for ($language_id = 1; $language_id <= 3; $language_id++) {
                TagTranslation::factory()->create([
                    'tag_id' => $id,
                    'language_id' => $language_id,
                    'title' => fake()->name(),
                ]);
                CategoryTranslation::factory()->create([
                    'category_id' => $id,
                    'language_id' => $language_id,
                    'title' => fake()->name(),
                ]);
            }
        };
        for ($id = 1; $id <= 100; $id++) {
            for ($language_id = 1; $language_id <= 3; $language_id++) {
                IngredientTranslation::factory()->create([
                    'ingredient_id' => $id,
                    'language_id' => $language_id,
                    'title' => fake()->name(),
                ]);
            }
        };
        for ($id = 1; $id <= 30; $id++) {
            for ($language_id = 1; $language_id <= 3; $language_id++) {
                MealTranslation::factory()->create([
                    'meal_id' => $id,
                    'language_id' => $language_id,
                    'title' => fake()->name(),
                    'description' => fake()->text(),
                ]);
            }
        };
    }
}
