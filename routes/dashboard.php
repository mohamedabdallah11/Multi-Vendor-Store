<?php

use App\Http\Controllers\Dashboard\CategoriesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ProductsController;
use App\Models\Category;


Route::group([
    'middleware' => ['auth'],
    'as' => 'dashboard.',
    'prefix' => 'dashboard',
], function () {

    Route::get('/', [DashboardController::class, 'index']);
    
    Route::get('/categories/trash',[CategoriesController::class,'trash'])
    ->name('categories.trash');
    Route::put('/categories/{category}/restore',[CategoriesController::class,'restore'])
    ->name('categories.restore');

    Route::delete('/categories/{category}/forceDelete', [CategoriesController::class,'forceDelete'])
    ->name('categories.forceDelete');
    Route::resource('categories', CategoriesController::class);
    Route::resource('products', ProductsController::class);
  
});
Route::delete('categories/deleteAll',[CategoriesController::class,'deleteAllCategories'])
->name('categories.deleteAll');