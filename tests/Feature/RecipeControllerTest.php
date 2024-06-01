<?php

namespace Tests\Feature;

use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class RecipeControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_all_recipes()
    {
        Recipe::factory()->count(3)->create();

        $response = $this->getJson('/recipes');

        $response->assertStatus(200)
            ->assertJsonCount(3);
    }

    public function test_can_create_recipe()
    {
        Storage::fake('public');

        $ingredient = Ingredient::factory()->create();
        $data = [
            'name' => 'Test Recipe',
            'slug' => 'test-recipe',
            'description' => 'Test description',
            'steps' => 'Test steps',
            'time_to_prepare' => 30,
            'fluff' => 'Test fluff',
            'image' => UploadedFile::fake()->image('recipe.jpg'),
            'ingredients' => [
                ['id' => $ingredient->id, 'quantity' => 2]
            ],
        ];

        $response = $this->postJson('/recipes', $data);

        $response->assertStatus(201)
            ->assertJsonFragment(['name' => 'Test Recipe']);
        Storage::disk('public')->assertExists('images/' . $data['image']->hashName());
    }

    public function test_can_get_recipe_by_id()
    {
        $recipe = Recipe::factory()->create();

        $response = $this->getJson('/recipes/' . $recipe->id);

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => $recipe->name]);
    }

    public function test_can_update_recipe()
    {
        $recipe = Recipe::factory()->create();
        $ingredient = Ingredient::factory()->create();
        $data = [
            'name' => 'Updated Recipe',
            'ingredients' => [
                ['id' => $ingredient->id, 'quantity' => 3]
            ],
        ];

        $response = $this->putJson('/recipes/' . $recipe->id, $data);

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'Updated Recipe']);
    }

    public function test_can_delete_recipe()
    {
        $recipe = Recipe::factory()->create();

        $response = $this->deleteJson('/recipes/' . $recipe->id);

        $response->assertStatus(204);
    }
}
