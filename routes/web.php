<?php

use App\Http\Controllers\user\sportWears\SportWearController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::middleware(['web'])->group(function () {
    Route::get('/', [\App\Http\Controllers\user\home\HomeController::class, 'index']);
    Route::get('/categories', [\App\Http\Controllers\user\categories\CategoriesController::class, 'index']);
    Route::get('/' . config('mainCategoriesById.' . config('mainCategories.GymDiscount.id')) . '/{id}', [\App\Http\Controllers\user\gym\GymController::class, 'show']);
    Route::get('/home', [\App\Http\Controllers\user\home\HomeController::class, 'index'])->name('home');
    Route::get('/coaches', [\App\Http\Controllers\user\coach\CoachController::class, 'index']);
    Route::get('/coaches/{id}', [\App\Http\Controllers\user\coach\CoachController::class, 'show']);
    Route::get('category/' . config('mainCategoriesById.'.config('mainCategories.Equipments.id')), [\App\Http\Controllers\user\equipments\EquipmentController::class, 'index']);
    Route::get('category/' . config('mainCategoriesById.'.config('mainCategories.Accessories.id')), [\App\Http\Controllers\user\accessories\AccessoriesController::class, 'index']);
    Route::get('category/' . config('mainCategoriesById.'.config('mainCategories.SportWear.id')), [\App\Http\Controllers\user\sportWears\SportWearController::class, 'index']);
    Route::get('category/' . config('mainCategoriesById.'.config('mainCategories.DietFood.id')), [\App\Http\Controllers\user\dietFood\DietFoodController::class, 'index']);
    Route::get('category/' . config('mainCategoriesById.'.config('mainCategories.Coaches.id')), [\App\Http\Controllers\user\coach\CoachController::class, 'index']);
    Route::get('category/' . config('mainCategoriesById.'.config('mainCategories.Supplements.id')), [\App\Http\Controllers\user\supplements\SupplementsController::class, 'index']);
    Route::get('category/' . config('mainCategoriesById.'.config('mainCategories.GymDiscount.id')), [\App\Http\Controllers\user\gym\GymController::class, 'index']);
    Route::get('category/' . config('mainCategoriesById.'.config('mainCategories.MusclesVideos.id')), [\App\Http\Controllers\user\muscles\MuscleController::class, 'index']);
    Route::get('/product/{product}', [\App\Http\Controllers\user\product\ProductController::class, 'show']);
    Route::get('/user/cart', [\App\Http\Controllers\user\cart\CartController::class, 'index']);
});

Auth::routes();
