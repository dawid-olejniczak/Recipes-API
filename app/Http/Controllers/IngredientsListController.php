<?php

namespace App\Http\Controllers;

use App\Models\IngredientsList;
use Illuminate\Http\Request;

class IngredientsListController extends Controller
{
    public function index()
    {
        $ingredientsList = IngredientsList::with('ingredients')->get();
        return response()->json($ingredientsList);
    }

    public function store(Request $request)
    {
        $request->validate([
            'ingredients' => 'array',
            'ingredients.*.id' => 'exists:ingredients,id',
            'ingredients.*.quantity' => 'required|integer|min:1',
            'ingredients.*.completed' => 'boolean',
        ]);

        $ingredientsList = IngredientsList::create();

        if ($request->has('ingredients')) {
            $ingredients = collect($request->ingredients)->mapWithKeys(function ($item) {
                return [$item['id'] => ['quantity' => $item['quantity'], 'completed' => $item['completed']]];
            });
            $ingredientsList->ingredients()->sync($ingredients);
        }

        return response()->json($ingredientsList->load('ingredients'), 201);
    }

    public function show($id)
    {
        $ingredientsList = IngredientsList::with('ingredients')->find($id);
        return response()->json($ingredientsList->load('ingredients'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ingredients' => 'array',
            'ingredients.*.id' => 'exists:ingredients,id',
            'ingredients.*.quantity' => 'required|integer|min:1',
            'ingredients.*.completed' => 'boolean',
        ]);

        $ingredientsList = IngredientsList::findOrFail($id);

        if ($request->has('ingredients')) {
            $ingredients = collect($request->ingredients)->mapWithKeys(function ($item) {
                return [$item['id'] => ['quantity' => $item['quantity'], 'completed' => $item['completed']]];
            });
            $ingredientsList->ingredients()->sync($ingredients);
        }

        return response()->json($ingredientsList->load('ingredients'));
    }

    public function destroy($id)
    {
        IngredientsList::destroy($id);
        return response()->json(null, 204);
    }

    public function completeItem($listId, $itemId)
    {
        $ingredientsList = IngredientsList::findOrFail($listId);

        $ingredientsList->ingredients()->updateExistingPivot($itemId, ['completed' => true]);

        return response()->json($ingredientsList->load('ingredients'));
    }

    public function uncompleteItem($listId, $itemId)
    {
        $ingredientsList = IngredientsList::findOrFail($listId);

        $ingredientsList->ingredients()->updateExistingPivot($itemId, ['completed' => false]);

        return response()->json($ingredientsList->load('ingredients'));
    }
}
