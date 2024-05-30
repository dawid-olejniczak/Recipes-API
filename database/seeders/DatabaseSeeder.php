<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use App\Models\IngredientsList;
use App\Models\Recipe;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);

        Ingredient::factory()->count(10)->create();
        Recipe::factory()->count(5)->create()->each(function ($recipe) {
            $ingredients = Ingredient::inRandomOrder()->take(3)->pluck('id');
            foreach ($ingredients as $ingredient) {
                $recipe->ingredients()->attach($ingredient, ['quantity' => rand(1, 10)]);
            }
        });

        IngredientsList::factory()->count(3)->create()->each(function ($ingredientsList) {
            $ingredients = Ingredient::inRandomOrder()->take(5)->pluck('id');
            foreach ($ingredients as $ingredient) {
                $ingredientsList->ingredients()->attach($ingredient, ['quantity' => rand(1, 5), 'completed' => false]);
            }
        });
    }
}
