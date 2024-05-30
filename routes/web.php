<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('recipes', \App\Http\Controllers\RecipeController::class);
Route::resource('ingredients', \App\Http\Controllers\IngredientController::class);
Route::resource('ingredients-list', \App\Http\Controllers\IngredientsListController::class);
Route::patch('ingredients-list/{listId}/complete-item/{itemId}', [\App\Http\Controllers\IngredientsListController::class, 'completeItem']);
Route::patch('ingredients-list/{listId}/uncomplete-item/{itemId}', [\App\Http\Controllers\IngredientsListController::class, 'uncompleteItem']);

