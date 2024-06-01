<?php

namespace Tests\Feature;

use App\Models\Ingredient;
use App\Models\IngredientsList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IngredientsListControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_all_ingredients_lists()
    {
        IngredientsList::factory()->count(3)->create();

        $response = $this->getJson('/ingredients-list');

        $response->assertStatus(200)
            ->assertJsonCount(3);
    }

    public function test_can_create_ingredients_list()
    {
        $ingredient = Ingredient::factory()->create();
        $data = [
            'ingredients' => [
                ['id' => $ingredient->id, 'quantity' => 2, 'completed' => false]
            ],
        ];

        $response = $this->postJson('/ingredients-list', $data);

        $response->assertStatus(201)
            ->assertJsonStructure(['id', 'ingredients']);
    }

    public function test_can_get_ingredients_list_by_id()
    {
        $ingredientsList = IngredientsList::factory()->create();

        $response = $this->getJson('/ingredients-list/' . $ingredientsList->id);

        $response->assertStatus(200)
            ->assertJsonStructure(['id', 'ingredients']);
    }

    public function test_can_update_ingredients_list()
    {
        $ingredientsList = IngredientsList::factory()->create();
        $ingredient = Ingredient::factory()->create();
        $data = [
            'ingredients' => [
                ['id' => $ingredient->id, 'quantity' => 3, 'completed' => true]
            ],
        ];

        $response = $this->patchJson('/ingredients-list/' . $ingredientsList->id, $data);

        $response->assertStatus(200)
            ->assertJsonFragment(['quantity' => 3]);
    }

    public function test_can_delete_ingredients_list()
    {
        $ingredientsList = IngredientsList::factory()->create();

        $response = $this->deleteJson('/ingredients-list/' . $ingredientsList->id);

        $response->assertStatus(204);
    }
}
