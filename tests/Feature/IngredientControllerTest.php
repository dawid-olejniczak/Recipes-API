<?php

namespace Tests\Feature;

use App\Models\Ingredient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IngredientControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_all_ingredients()
    {
        Ingredient::factory()->count(3)->create();

        $response = $this->getJson('/ingredients');

        $response->assertStatus(200)
            ->assertJsonCount(3);
    }

    public function test_can_create_ingredient()
    {
        $data = [
            'name' => 'Sugar',
            'unit' => 'grams',
        ];

        $response = $this->postJson('/ingredients', $data);

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'Sugar']);
    }

    public function test_can_get_ingredient_by_id()
    {
        $ingredient = Ingredient::factory()->create();

        $response = $this->getJson('/ingredients/' . $ingredient->id);

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => $ingredient->name]);
    }

    public function test_can_update_ingredient()
    {
        $ingredient = Ingredient::factory()->create();
        $data = [
            'name' => 'Updated Sugar',
            'unit' => 'grams',
        ];

        $response = $this->putJson('/ingredients/' . $ingredient->id, $data);

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'Updated Sugar']);
    }

    public function test_can_delete_ingredient()
    {
        $ingredient = Ingredient::factory()->create();

        $response = $this->deleteJson('/ingredients/' . $ingredient->id);

        $response->assertStatus(204);
    }
}
