<?php

use App\Http\Controllers\Dashboard\CategoriesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Models\Category;


Route::group([
    'middleware' => ['auth'],
    'as' => 'dashboard.',
    'prefix' => 'dashboard',
], function () {

    Route::get('/', [DashboardController::class, 'index']);
    Route::resource('categories', CategoriesController::class);
  
});
Route::delete('categories/deleteAll',[CategoriesController::class,'deleteAllCategories'])
->name('categories.deleteAll');