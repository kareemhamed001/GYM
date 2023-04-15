<?php

use Illuminate\Support\Facades\Route;

Route::prefix('coach')->group(function () {
    Route::get('/', [\App\Http\Controllers\coach\DashboardController::class, 'index'])->name('coach.home');
    Route::resource('/users', \App\Http\Controllers\coach\user\UserController::class,
        [
            'names' => [
                'index' => 'coach.users.index',
                'create' => 'coach.users.create',
                'store' => 'coach.users.store',
                'show' => 'coach.users.show',
                'edit' => 'coach.users.index',
                'update' => 'coach.users.edit',
                'destroy' => 'coach.users.destroy',
            ]
        ]
    );
    Route::resource('/brands', \App\Http\Controllers\coach\user\UserController::class,
        [
            'names' => [
                'index' => 'coach.brands.index',
                'create' => 'coach.brands.create',
                'store' => 'coach.brands.store',
                'show' => 'coach.brands.show',
                'edit' => 'coach.brands.index',
                'update' => 'coach.brands.edit',
                'destroy' => 'coach.brands.destroy',
            ]
        ]
    );

    Route::resource('/category', \App\Http\Controllers\coach\user\UserController::class,
        [
            'names' => [
                'index' => 'coach.categorys.index',
                'create' => 'coach.categorys.create',
                'store' => 'coach.categorys.store',
                'show' => 'coach.categorys.show',
                'edit' => 'coach.categorys.index',
                'update' => 'coach.categorys.edit',
                'destroy' => 'coach.categorys.destroy',
            ]
        ]
    );

    Route::resource('/courses', \App\Http\Controllers\coach\user\UserController::class,
        [
            'names' => [
                'index' => 'coach.courses.index',
                'create' => 'coach.courses.create',
                'store' => 'coach.courses.store',
                'show' => 'coach.courses.show',
                'edit' => 'coach.courses.index',
                'update' => 'coach.courses.edit',
                'destroy' => 'coach.courses.destroy',
            ]
        ]
    );

    Route::resource('/purchase', \App\Http\Controllers\coach\user\UserController::class,
        [
            'names' => [
                'index' => 'coach.purchases.index',
                'create' => 'coach.purchases.create',
                'store' => 'coach.purchases.store',
                'show' => 'coach.purchases.show',
                'edit' => 'coach.purchases.index',
                'update' => 'coach.purchases.edit',
                'destroy' => 'coach.purchases.destroy',
            ]
        ]
    );
    Route::resource('/subscriptions', \App\Http\Controllers\coach\user\UserController::class,
        [
            'names' => [
                'index' => 'coach.subscriptions.index',
                'create' => 'coach.subscriptions.create',
                'store' => 'coach.subscriptions.store',
                'show' => 'coach.subscriptions.show',
                'edit' => 'coach.subscriptions.index',
                'update' => 'coach.subscriptions.edit',
                'destroy' => 'coach.subscriptions.destroy',
            ]
        ]
    );

    Route::resource('/supplements', \App\Http\Controllers\coach\user\UserController::class,
        [
            'names' => [
                'index' => 'coach.supplements.index',
                'create' => 'coach.supplements.create',
                'store' => 'coach.supplements.store',
                'show' => 'coach.supplements.show',
                'edit' => 'coach.supplements.index',
                'update' => 'coach.supplements.edit',
                'destroy' => 'coach.supplements.destroy',
            ]
        ]
    );
    Route::resource('/videos', \App\Http\Controllers\coach\user\UserController::class,
        [
            'names' => [
                'index' => 'coach.videos.index',
                'create' => 'coach.videos.create',
                'store' => 'coach.videos.store',
                'show' => 'coach.videos.show',
                'edit' => 'coach.videos.index',
                'update' => 'coach.videos.edit',
                'destroy' => 'coach.videos.destroy',
            ]
        ]
    );
});
