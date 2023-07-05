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

Route::resource('/brands', \App\Http\Controllers\api\brand\BrandController::class,
    [
        'only' => [
            'index', 'destroy', 'store', 'update', 'show'
        ]
    ]
);
Route::get('brands/{id}/products', [\App\Http\Controllers\api\brand\BrandController::class, 'getProductsByBrandId']);
Route::post('brands/delete-collection', [\App\Http\Controllers\api\brand\BrandController::class, 'deleteArrayOfBrands']);

Route::resource('/categories', \App\Http\Controllers\api\category\CategoryController::class,
    [
        'only' => [
            'index', 'show', 'update'
        ]
    ]
);


Route::resource('/sub-categories', \App\Http\Controllers\api\subCategory\SubCategoryController::class,
    [
        'only' => [
            'index', 'destroy', 'store', 'update', 'show'
        ]
    ]
);
Route::post('sub-categories/delete-collection', [\App\Http\Controllers\api\subCategory\SubCategoryController::class, 'deleteArrayOfSubCategories']);
Route::get('sub-categories/{id}/products', [\App\Http\Controllers\api\subCategory\SubCategoryController::class, 'products']);


Route::resource('/muscles', \App\Http\Controllers\api\muscle\MuscleController::class,
    [
        'only' => [
            'index', 'destroy', 'store', 'update', 'show'
        ]
    ]
);

Route::get('muscles/{id}/parts', [\App\Http\Controllers\api\muscle\MuscleController::class, 'parts']);
Route::get('muscles/{id}/{partId}/files', [\App\Http\Controllers\api\muscle\MuscleController::class, 'partFiles']);
Route::post('muscles/delete-collection', [\App\Http\Controllers\api\muscle\MuscleController::class, 'deleteCollection']);
Route::post('muscles/{muscleId}/{curriculumId}/delete-part', [\App\Http\Controllers\api\muscle\MuscleController::class, 'deletePart']);
Route::post('muscles/{muscleId}/{curriculumId}/{fileId}/delete-file', [\App\Http\Controllers\api\muscle\MuscleController::class, 'deletePartFile']);


Route::resource('/products', \App\Http\Controllers\api\products\ProductsController::class,
    [
        'only' => [
            'index', 'destroy', 'store', 'update', 'show'
        ]
    ]
);
//Route::get('products/{id}/brand', [\App\Http\Controllers\api\products\ProductsController::class, 'getBrandByProductId']);
Route::post('products/{productId}/{imageId}/delete-image', [\App\Http\Controllers\api\products\ProductsController::class, 'deleteImage']);
Route::post('products/{productId}/{colorId}/delete-color', [\App\Http\Controllers\api\products\ProductsController::class, 'deleteColor']);
Route::post('products/{productId}/{sizeId}/delete-size', [\App\Http\Controllers\api\products\ProductsController::class, 'deleteSize']);
Route::get('products/{id}/purchases', [\App\Http\Controllers\api\products\ProductsController::class, 'getPurchasesByProductId']);
Route::post('products/delete-collection', [\App\Http\Controllers\api\products\ProductsController::class, 'deleteArrayOfProducts']);


Route::resource('/carts', \App\Http\Controllers\api\cart\CartController::class,
    [
        'only' => [
            'index', 'destroy', 'store', 'show'
        ]
    ]
);
Route::post('carts/{id}', [\App\Http\Controllers\api\cart\CartController::class, 'update']);
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

Route::get('statistics', [\App\Http\Controllers\api\dashBoard\DashBoardController::class, 'overAllStatistics']);
Route::get('year-statistics', [\App\Http\Controllers\api\dashBoard\DashBoardController::class, 'yearStatistics']);
Route::get('recent-muscles-clients/{limit}', [\App\Http\Controllers\api\dashBoard\DashBoardController::class, 'recentmusclesClients']);
Route::get('recent-products-clients/{limit}', [\App\Http\Controllers\api\dashBoard\DashBoardController::class, 'recentProductsClients']);
Route::post('users/delete-collection', [\App\Http\Controllers\api\user\UserController::class, 'deleteArrayOfUsers']);

Route::get('gyms', [\App\Http\Controllers\api\gym\GymController::class, 'index']);
Route::post('gyms', [\App\Http\Controllers\api\gym\GymController::class, 'store']);
Route::get('gyms/{gym}', [\App\Http\Controllers\api\gym\GymController::class, 'show']);
Route::put('gyms/{gym}', [\App\Http\Controllers\api\gym\GymController::class, 'update']);
Route::delete('gyms/{gym}', [\App\Http\Controllers\api\gym\GymController::class, 'destroy']);
Route::post('gyms/delete-collection', [\App\Http\Controllers\api\gym\GymController::class, 'deleteCollection']);

Route::post('settings/logo', [\App\Http\Controllers\api\setting\SettingsController::class, 'changeLogo']);
Route::post('settings/info', [\App\Http\Controllers\api\setting\SettingsController::class, 'updateInfo']);

Route::group([
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/register', [UserController::class, 'register']);
    Route::middleware('jwt')->group(function () {
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


Route::post('tmp-upload', [\App\Http\Controllers\api\products\ProductsController::class, 'tmpUpload']);
Route::delete('tmp-delete', [\App\Http\Controllers\api\products\ProductsController::class, 'tmpDelete']);

Route::get('category/' . config('mainCategoriesById.' . config('mainCategories.Equipments.id')), [\App\Http\Controllers\api\equipments\EquipmentController::class, 'index']);
Route::get('category/' . config('mainCategoriesById.' . config('mainCategories.Accessories.id')), [\App\Http\Controllers\api\accessories\AccessoriesController::class, 'index']);
Route::get('category/' . config('mainCategoriesById.' . config('mainCategories.SportWear.id')), [\App\Http\Controllers\api\sportWears\SportWearController::class, 'index']);
Route::get('category/' . config('mainCategoriesById.' . config('mainCategories.DietFood.id')), [\App\Http\Controllers\api\dietFood\DietFoodController::class, 'index']);
Route::get('category/' . config('mainCategoriesById.' . config('mainCategories.Coaches.id')), [\App\Http\Controllers\api\coach\CoachController::class, 'index']);
Route::get('category/' . config('mainCategoriesById.' . config('mainCategories.Supplements.id')), [\App\Http\Controllers\api\supplements\SupplementsController::class, 'index']);
Route::get('category/' . config('mainCategoriesById.' . config('mainCategories.GymDiscount.id')), [\App\Http\Controllers\api\gym\GymController::class, 'index']);
Route::get('category/' . config('mainCategoriesById.' . config('mainCategories.MusclesVideos.id')), [\App\Http\Controllers\api\muscle\MuscleController::class, 'index']);
