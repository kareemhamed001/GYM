<?php

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
Route::middleware(['web'])->group(function (){
    Route::get('/', [\App\Http\Controllers\user\home\HomeController::class,'index']);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/coaches', [\App\Http\Controllers\user\coach\CoachController::class,'index']);
    Route::get('/coaches/{id}', [\App\Http\Controllers\user\coach\CoachController::class,'show']);
    Route::get('/store', [\App\Http\Controllers\user\store\StoreController::class,'index'])->name('user.store');
    Route::get('/product/{product}', [\App\Http\Controllers\user\product\ProductController::class,'show']);
});





//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Auth::routes();

Auth::routes();


