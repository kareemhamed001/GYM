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
Route::get('brands/{id}/categories', [\App\Http\Controllers\api\brand\BrandController::class, 'getCategoriesBrandId']);
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
Route::get('coaches/{id}/videos', [\App\Http\Controllers\api\coach\CoachController::class, 'getVideosByCoachId']);
Route::get('coaches/{id}/courses', [\App\Http\Controllers\api\coach\CoachController::class, 'getCoursesByCoachId']);

Route::resource('/categories', \App\Http\Controllers\api\category\CategoryController::class,
    [
        'only' => [
            'index', 'destroy', 'store', 'update', 'show'
        ]
    ]
);

Route::get('categories/{id}/brands', [\App\Http\Controllers\api\category\CategoryController::class, 'getBrandsByCategoryId']);
Route::post('categories/delete-collection', [\App\Http\Controllers\api\category\CategoryController::class, 'deleteArrayOfCategories']);
Route::post('categories/add-brand', [\App\Http\Controllers\api\category\CategoryController::class, 'addBrandToCategory']);

Route::resource('/courses', \App\Http\Controllers\api\course\CourseController::class,
    [
        'only' => [
            'index', 'destroy', 'store', 'update', 'show'
        ]
    ]
);

Route::get('courses/{id}/videos', [\App\Http\Controllers\api\course\CourseController::class, 'getVideosByCourseId']);
Route::get('courses/{id}/coach', [\App\Http\Controllers\api\course\CourseController::class, 'getCourseCoach']);
Route::post('courses/delete-collection', [\App\Http\Controllers\api\course\CourseController::class, 'deleteArrayOfCourses']);

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
Route::get('subscriptions/{id}/course', [\App\Http\Controllers\api\subscription\SubscriptionController::class, 'getCourseBySubscriptionId']);


Route::resource('/products', \App\Http\Controllers\api\supplement\SupplementController::class,
    [
        'only' => [
            'index', 'destroy', 'store', 'update', 'show'
        ]
    ]
);
Route::get('products/{id}/brand', [\App\Http\Controllers\api\supplement\SupplementController::class, 'getBrandByProductId']);
Route::get('products/{id}/coach', [\App\Http\Controllers\api\supplement\SupplementController::class, 'getCoachByProductId']);
Route::get('products/{id}/purchases', [\App\Http\Controllers\api\supplement\SupplementController::class, 'getPurchasesByProductId']);
Route::post('products/delete-collection', [\App\Http\Controllers\api\supplement\SupplementController::class, 'deleteArrayOfProducts']);


Route::resource('/videos', \App\Http\Controllers\api\video\VideoController::class,
    [
        'only' => [
            'index', 'destroy', 'store', 'update', 'show'
        ]
    ]
);
Route::get('videos/{id}/coach', [\App\Http\Controllers\api\video\VideoController::class, 'getCoachByVideoId']);
Route::get('videos/{id}/courses', [\App\Http\Controllers\api\video\VideoController::class, 'getCoursesByVideoId']);
Route::post('videos/delete-collection', [\App\Http\Controllers\api\video\VideoController::class, 'deleteArrayOfVideos']);

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
