<?php

use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//Route::get('brands',[\App\Http\Controllers\api\brand\BrandController::class,'index']);
//Route::post('brands',[\App\Http\Controllers\api\brand\BrandController::class,'store']);
//Route::put('brands/{id}',[\App\Http\Controllers\api\brand\BrandController::class,'update']);
//Route::delete('brands/{id}',[\App\Http\Controllers\api\brand\BrandController::class,'destroy']);
//Route::get('brands/{id}',[\App\Http\Controllers\api\brand\BrandController::class,'show']);
//Route::resource('brands', \App\Http\Controllers\api\brand\BrandController::class,
//    [
//        'only' => [
//            'index', 'destroy', 'store', 'update', 'show'
//        ]
//    ]
//);


Route::resource('/brands', \App\Http\Controllers\api\brand\BrandController::class,
    [
        'only' => [
            'index', 'destroy', 'store', 'update', 'show'
        ]
    ]
);
Route::resource('/coaches', \App\Http\Controllers\api\coach\CoachController::class,
    [
        'only' => [
            'index', 'destroy', 'store', 'update', 'show'
        ]
    ]
);
Route::resource('/categories', \App\Http\Controllers\api\category\CategoryController::class,
    [
        'only' => [
            'index', 'destroy', 'store', 'update', 'show'
        ]
    ]
);

Route::resource('/courses', \App\Http\Controllers\api\course\CourseController::class,
    [
        'only' => [
            'index', 'destroy', 'store', 'update', 'show'
        ]
    ]
);

Route::resource('/purchase', \App\Http\Controllers\api\purchase\PurchaseController::class,
    [
        'only' => [
            'index', 'destroy', 'store', 'update', 'show'
        ]
    ]
);
Route::resource('/subscriptions', \App\Http\Controllers\api\subscription\SubscriptionController::class,
    [
        'only' => [
            'index', 'destroy', 'store', 'update', 'show'
        ]
    ]
);

Route::resource('/supplements', \App\Http\Controllers\api\supplement\SupplementController::class,
    [
        'only' => [
            'index', 'destroy', 'store', 'update', 'show'
        ]
    ]
);
Route::resource('/videos', \App\Http\Controllers\api\video\VideoController::class,
    [
        'only' => [
            'index', 'destroy', 'store', 'update', 'show'
        ]
    ]
);

Route::group([
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});
