<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngredientsList extends Model
{
    use HasFactory;
    use HasFactory;

    protected $fillable = [];

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'ingredient_list_ingredient')
            ->withPivot('quantity', 'completed');
    }
}
