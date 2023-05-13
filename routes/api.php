<?php

use App\Http\Controllers\api\products\SupplementController;
use App\Http\Controllers\api\user\UserController;
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
Route::resource('/users', \App\Http\Controllers\api\user\UserController::class,
    [
        'only' => [
            'index'
        ]
    ]
);

Route::resource('/brands', \App\Http\Controllers\api\brand\BrandController::class,
    [
        'only' => [
            'index', 'destroy', 'store', 'update', 'show'
        ]
    ]
);
Route::get('brands/{id}/coach', [\App\Http\Controllers\api\brand\BrandController::class, 'getCoachByBrandId']);
Route::post('brands/to-category', [\App\Http\Controllers\api\brand\BrandController::class, 'addBrandToCategory']);
Route::get('brands/{id}/products', [\App\Http\Controllers\api\brand\BrandController::class, 'getProductsByBrandId']);
Route::post('brands/delete-collection', [\App\Http\Controllers\api\brand\BrandController::class, 'deleteArrayOfBrands']);


Route::resource('/coaches', \App\Http\Controllers\api\coach\CoachController::class,
    [
        'only' => [
            'index', 'destroy', 'store', 'update', 'show'
        ]
    ]
);
Route::get('coaches/{id}/products', [\App\Http\Controllers\api\coach\CoachController::class, 'getProductsByCoachId']);
Route::get('coaches/{id}/brands', [\App\Http\Controllers\api\coach\CoachController::class, 'getBrandsByCoachId']);
Route::get('coaches/{id}/muscles', [\App\Http\Controllers\api\coach\CoachController::class, 'getmusclesByCoachId']);

Route::resource('/categories', \App\Http\Controllers\api\category\CategoryController::class,
    [
        'only' => [
            'show','update'
        ]
    ]
);


Route::post('sub-categories/delete-collection', [\App\Http\Controllers\api\subCategory\SubCategoryController::class, 'deleteArrayOfSubCategories']);

Route::resource('/sub-categories', \App\Http\Controllers\api\subCategory\SubCategoryController::class,
    [
        'only' => [
            'index', 'destroy', 'store', 'update', 'show'
        ]
    ]
);

Route::resource('/muscles', \App\Http\Controllers\api\muscle\MuscleController::class,
    [
        'only' => [
            'index', 'destroy', 'store', 'update', 'show'
        ]
    ]
);

Route::post('muscles/{muscleId}/{curriculumId}/delete-curriculum', [\App\Http\Controllers\api\muscle\MuscleController::class, 'deleteCurriculum']);
Route::post('muscles/{muscleId}/{curriculumId}/{fileId}/delete-file', [\App\Http\Controllers\api\muscle\MuscleController::class, 'deleteCurriculumFile']);
Route::get('muscles/{id}/coach', [\App\Http\Controllers\api\muscle\MuscleController::class, 'getmuscleCoach']);
Route::post('muscles/delete-collection', [\App\Http\Controllers\api\muscle\MuscleController::class, 'deleteArrayOfmuscles']);

Route::resource('/purchases', \App\Http\Controllers\api\purchase\PurchaseController::class,
    [
        'only' => [
            'index', 'destroy', 'store', 'update', 'show'
        ]
    ]
);
Route::get('purchases/{id}/user', [\App\Http\Controllers\api\purchase\PurchaseController::class, 'getUserByPurchaseId']);
Route::get('purchases/{id}/product', [\App\Http\Controllers\api\purchase\PurchaseController::class, 'getProductByPurchaseId']);


Route::resource('/subscriptions', \App\Http\Controllers\api\subscription\SubscriptionController::class,
    [
        'only' => [
            'index', 'destroy', 'store', 'update', 'show'
        ]
    ]
);
Route::get('subscriptions/{id}/user', [\App\Http\Controllers\api\subscription\SubscriptionController::class, 'getUserBySubscriptionId']);
Route::get('subscriptions/{id}/muscle', [\App\Http\Controllers\api\subscription\SubscriptionController::class, 'getmuscleBySubscriptionId']);


Route::resource('/products', \App\Http\Controllers\api\products\ProductsController::class,
    [
        'only' => [
            'index', 'destroy', 'store', 'update', 'show'
        ]
    ]
);
Route::get('products/{id}/brand', [\App\Http\Controllers\api\products\SupplementController::class, 'getBrandByProductId']);
Route::post('products/{productId}/{imageId}/delete-image', [\App\Http\Controllers\api\products\SupplementController::class, 'deleteImage']);
Route::post('products/{productId}/{imageId}/delete-color', [\App\Http\Controllers\api\products\SupplementController::class, 'deleteColor']);
Route::post('products/{productId}/{imageId}/delete-size', [\App\Http\Controllers\api\products\SupplementController::class, 'deleteSize']);
Route::get('products/{id}/coach', [\App\Http\Controllers\api\products\SupplementController::class, 'getCoachByProductId']);
Route::get('products/{id}/purchases', [\App\Http\Controllers\api\products\SupplementController::class, 'getPurchasesByProductId']);
Route::post('products/delete-collection', [\App\Http\Controllers\api\products\SupplementController::class, 'deleteArrayOfProducts']);


Route::resource('/carts', \App\Http\Controllers\api\cart\CartController::class,
    [
        'only' => [
            'index', 'destroy', 'store', 'update', 'show'
        ]
    ]
);
Route::get('carts/{id}/user', [\App\Http\Controllers\api\cart\CartController::class, 'getUserByCartId']);
Route::get('carts/{id}/product', [\App\Http\Controllers\api\cart\CartController::class, 'getProductByCartId']);

Route::resource('/wishlists', \App\Http\Controllers\api\wishlist\WishListController::class,
    [
        'only' => [
            'index', 'destroy', 'store', 'update', 'show'
        ]
    ]
);

Route::get('wishlists/{id}/user', [\App\Http\Controllers\api\wishlist\WishListController::class, 'getUserByWishlistId']);
Route::get('wishlists/{id}/product', [\App\Http\Controllers\api\wishlist\WishListController::class, 'getProductByWishlistId']);

Route::get('statistics', [\App\Http\Controllers\api\dashBoard\DashBoardController::class, 'overAllStatistics']);
Route::get('year-statistics', [\App\Http\Controllers\api\dashBoard\DashBoardController::class, 'yearStatistics']);
Route::get('recent-muscles-clients/{limit}', [\App\Http\Controllers\api\dashBoard\DashBoardController::class, 'recentmusclesClients']);
Route::get('recent-products-clients/{limit}', [\App\Http\Controllers\api\dashBoard\DashBoardController::class, 'recentProductsClients']);

Route::post('users/delete-collection', [\App\Http\Controllers\api\user\UserController::class, 'deleteArrayOfUsers']);
Route::group([
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/logout', [UserController::class, 'logout']);
    Route::post('/refresh', [UserController::class, 'refresh']);
    Route::get('/user-profile', [UserController::class, 'userProfile']);
    Route::post('/update-profile', [UserController::class, 'update']);
    Route::post('/change-password', [UserController::class, 'changePassword']);
    Route::post('/my-orders', [UserController::class, 'myOrders']);
    Route::post('/my-cart', [UserController::class, 'myCart']);
    Route::post('/my-wishlist', [UserController::class, 'myWishList']);
    Route::post('/my-plans', [UserController::class, 'myPlans']);
    Route::post('/coach', [UserController::class, 'coach']);
});
