<?php

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


Route::resource('/brands', \App\Http\Controllers\api\brand\BrandController::class,
    [
        'only' => [
            'index', 'destroy', 'store', 'update', 'show'
        ]
    ]
);
Route::get('brands/{id}/products', [\App\Http\Controllers\api\brand\BrandController::class, 'getProductsByBrandId']);
Route::get('brands/{id}/categories', [\App\Http\Controllers\api\brand\BrandController::class, 'getCategoriesBrandId']);
Route::post('brands/delete-collection', [\App\Http\Controllers\api\brand\BrandController::class, 'deleteArrayOfBrands']);

Route::get('coaches/{id}/products', [\App\Http\Controllers\api\coach\CoachController::class, 'getProductsByCoachId']);
Route::get('coaches/{id}/brands', [\App\Http\Controllers\api\coach\CoachController::class, 'getBrandsByCoachId']);
Route::get('coaches/{id}/muscles', [\App\Http\Controllers\api\coach\CoachController::class, 'getmusclesByCoachId']);

Route::resource('/categories', \App\Http\Controllers\api\category\CategoryController::class,
    [
        'only' => [
            'index','show','update'
        ]
    ]
);


Route::post('sub-categories/delete-collection', [\App\Http\Controllers\api\subCategory\SubCategoryController::class, 'deleteArrayOfSubCategories']);
Route::post('tmp-upload', [\App\Http\Controllers\api\products\ProductsController::class, 'tmpUpload']);
Route::delete('tmp-delete', [\App\Http\Controllers\api\products\ProductsController::class, 'tmpDelete']);

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
Route::get('muscles/{id}/parts', [\App\Http\Controllers\api\muscle\MuscleController::class, 'getmuscleParts']);
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
Route::get('products/{id}/brand', [\App\Http\Controllers\api\products\ProductsController::class, 'getBrandByProductId']);
Route::post('products/{productId}/{imageId}/delete-image', [\App\Http\Controllers\api\products\ProductsController::class, 'deleteImage']);
Route::post('products/{productId}/{imageId}/delete-color', [\App\Http\Controllers\api\products\ProductsController::class, 'deleteColor']);
Route::post('products/{productId}/{imageId}/delete-size', [\App\Http\Controllers\api\products\ProductsController::class, 'deleteSize']);
Route::get('products/{id}/coach', [\App\Http\Controllers\api\products\ProductsController::class, 'getCoachByProductId']);
Route::get('products/{id}/purchases', [\App\Http\Controllers\api\products\ProductsController::class, 'getPurchasesByProductId']);
Route::post('products/delete-collection', [\App\Http\Controllers\api\products\ProductsController::class, 'deleteArrayOfProducts']);


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

Route::post('gyms',[\App\Http\Controllers\api\gym\GymController::class,'store']);
Route::get('gyms/{gym}',[\App\Http\Controllers\api\gym\GymController::class,'show']);
Route::put('gyms/{gym}',[\App\Http\Controllers\api\gym\GymController::class,'update']);
Route::delete('gyms/{gym}',[\App\Http\Controllers\api\gym\GymController::class,'destroy']);
Route::delete('gyms/{gym}',[\App\Http\Controllers\api\gym\GymController::class,'destroy']);
Route::post('gyms/delete-collection',[\App\Http\Controllers\api\gym\GymController::class,'deleteCollection']);



Route::group([
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/register', [UserController::class, 'register']);
    Route::middleware('jwt')->group(function (){
        Route::get('/user-profile', [UserController::class, 'userProfile']);
        Route::get('/users', [UserController::class, 'users']);
        Route::post('/update-profile', [UserController::class, 'update']);
        Route::post('/change-password', [UserController::class, 'changePassword']);
        Route::post('/my-orders', [UserController::class, 'myOrders']);
        Route::post('/logout', [UserController::class, 'logout']);
        Route::post('/refresh', [UserController::class, 'refresh']);
        Route::post('/my-cart', [UserController::class, 'myCart']);
        Route::post('/my-wishlist', [UserController::class, 'myWishList']);

        Route::post('/coach', [UserController::class, 'coach']);
    });

});
