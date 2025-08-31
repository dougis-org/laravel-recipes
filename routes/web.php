<?php

use Illuminate\Support\Facades\Route;

Route::resource('recipe', App\Http\Controllers\RecipeController::class, [
    'only' => ['index', 'show']
]);

Route::resource('contact', App\Http\Controllers\ContactController::class, [
    'only' => ['index', 'store']
]);

Route::resource('cookbook', App\Http\Controllers\CookbookController::class, [
    'only' => ['index', 'show']
]);

Route::get('/', function () {
    return Redirect::route('recipe.index', [
        'sortField' => 'date_added',
        'sortOrder' => 'desc',
        'displayCount' => 30
    ]);
});

Route::get('/reset-cache', function () {
    \Artisan::call('optimize:clear');
    return "Cache cleared!";
});
