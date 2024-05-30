<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description', 'steps', 'time_to_prepare', 'image', 'fluff'];

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'ingredients_recipes')->withPivot('quantity');
    }
}
