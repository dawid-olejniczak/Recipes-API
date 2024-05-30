<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecipeRequest;
use App\Models\Recipe;
use Illuminate\Support\Facades\Storage;


class RecipeController extends Controller
{
    public function index()
    {
        $recipes = Recipe::with('ingredients')->get();
        return response()->json($recipes);
    }

    public function store(RecipeRequest $request)
    {
        $data = $request->all();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $data['image'] = $path;
        }

        $recipe = Recipe::create($data);

        if ($request->has('ingredients')) {
            $ingredients = collect($request->ingredients)->mapWithKeys(function ($item) {
                return [$item['id'] => ['quantity' => $item['quantity']]];
            });
            $recipe->ingredients()->sync($ingredients);
        }

        return response()->json($recipe->load('ingredients'), 201);
    }

    public function show($id)
    {
        $recipe = Recipe::with('ingredients')->find($id);
        return response()->json($recipe);
    }

    public function update(RecipeRequest $request, $id)
    {
        $recipe = Recipe::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($recipe->image) {
                Storage::disk('public')->delete($recipe->image);
            }
            $path = $request->file('image')->store('images', 'public');
            $data['image'] = $path;
        }


        $recipe->update($data);

        if ($request->has('ingredients')) {
            $ingredients = collect($request->ingredients)->mapWithKeys(function ($item) {
                return [$item['id'] => ['quantity' => $item['quantity']]];
            });
            $recipe->ingredients()->sync($ingredients);
        }

        return response()->json($recipe->load('ingredients'));
    }

    public function destroy($id)
    {
        $recipe = Recipe::findOrFail($id);
        if ($recipe->image) {
            Storage::disk('public')->delete($recipe->image);
        }
        $recipe->delete();
        return response()->json(null, 204);
    }
}
