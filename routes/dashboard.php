<?php

use App\Http\Controllers\Dashboard\CategoriesController as CategoriesController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\StoreController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Front\CheckoutController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),

        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],

    ],
    function () {
        Route::group([
            'prefix' => 'dashboard/',

            'middleware' => ['auth'],

        ], function () {
            Route::get('/', [DashboardController::class, 'index'])
                ->name('dashboard');
            Route::get('categories/trash', [CategoriesController::class, 'trash'])->name('trash');
            Route::put('categories/trash/{name}/restore', [CategoriesController::class, 'restore'])->name('restore');
            Route::delete('categories/trash/{category}/force-delete', [CategoriesController::class, 'forcedelete'])->name('forcedelete');

            Route::resource('categories', CategoriesController::class);
            Route::resource('products', ProductController::class);
            Route::get('stores/trash', [StoreController::class, 'trash'])->name('stores.trash');
            Route::put('stores/trash/{name}/restore', [StoreController::class, 'restore'])->name('stores.restore');
            Route::delete('stores/trash/{name}/force-delete', [StoreController::class, 'forcedelete'])->name('stores.forcedelete');

            Route::resource('stores', StoreController::class);

            route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('auth');
            route::patch('profile/update', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');
            route::get('profile/{name}/show', [ProfileController::class, 'show'])->name('profile.show')->middleware('auth');

            Route::get('product/trash', [ProductController::class, 'trash'])->name('product.trash');
            Route::put('product/trash/{name}/restore', [ProductController::class, 'restore'])->name('product.restore');
            Route::get('product/trash/restore_all', [ProductController::class, 'restore_all'])->name('product.restore_all');
            Route::delete('product/trash/{product}/force-delete', [ProductController::class, 'forcedelete'])->name('product-forecdelete');

            // check out
            Route::get('checkout', [CheckoutController::class, 'create'])->name('checkout');
            Route::post('checkout/store', [CheckoutController::class, 'store'])->name('checkout.store');

            Route::get('orders/notification', [ProfileController::class, 'notify'])->name('orders.notify');
        });
    }
);