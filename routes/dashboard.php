<?php

use App\Http\Controllers\Dashboard\CategoriesController as CategoriesController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => ['auth','admin'],
    'prefix' => 'dashboard/'
], function () {
    Route::get('/', [DashboardController::class, 'index'])
        ->name('dashboard');
    Route::get('categories/trash', [CategoriesController::class, 'trash'])->name('trash');
    Route::put('categories/trash/{name}/restore', [CategoriesController::class, 'restore'])->name('restore');
    Route::delete('categories/trash/{category}/force-delete', [CategoriesController::class, 'forcedelete'])->name('forcedelete');

    Route::resource('categories', CategoriesController::class);
    Route::resource('products', ProductController::class);
    // Route::resource('categories', CategoriesController::class)->names([
    //     'index'=>'dashboard.categories.index',
    //     'create'=>'dashboard.categories.create'
    //هنا مثلا لو حابب اعدل على اسم الروات الخاص بالريسورس براحتى
    // ]);
    route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit')->withoutMiddleware('admin');;
    route::patch('profile/update', [ProfileController::class, 'update'])->name('profile.update')->withoutMiddleware('admin');;

    Route::get('product/trash', [ProductController::class, 'trash'])->name('product.trash');
    Route::put('product/trash/{name}/restore', [ProductController::class, 'restore'])->name('product.restore');
    Route::get('product/trash/restore_all', [ProductController::class, 'restore_all'])->name('product.restore_all');
    Route::delete('product/trash/{product}/force-delete', [ProductController::class, 'forcedelete'])->name('product-forecdelete');

});
