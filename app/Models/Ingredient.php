<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;


    protected $fillable = ['name', 'unit'];

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class, 'ingredients_recipes')->withPivot('quantity');
    }

    public function ingredientLists()
    {
        return $this->belongsToMany(IngredientsList::class, 'ingredient_list_ingredient')
            ->withPivot('quantity', 'completed');
    }
}
