<?php

namespace App\Http\Controllers;

use App\Http\Requests\IngredientRequest;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class IngredientController extends Controller
{
    public function index(Request $request)
    {
        $query = Ingredient::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'LIKE', "%{$search}%")
                ->orWhere('unit', 'LIKE', "%{$search}%");
        }

        $ingredients = $query->get();
        return response()->json($ingredients);
    }

    public function store(IngredientRequest $request)
    {
        $ingredient = Ingredient::create($request->all());
        return response()->json($ingredient);
    }

    public function show($id)
    {
        Log::info('Dummy Log');
        $ingredient = Ingredient::find($id);
        return response()->json($ingredient);
    }

    public function update(IngredientRequest $request, $id)
    {
        $ingredient = Ingredient::findOrFail($id);
        $ingredient->update($request->all());
        return response()->json($ingredient);
    }

    public function destroy($id)
    {
        Ingredient::destroy($id);
        return response()->json(null, 204);
    }
}
