<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\front\CartController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('ld', [HomeController::class, 'cart_shop'])->name('cart_shop');
Route::get('/products', [ProductController::class, 'index'])->name('front.products.index');
Route::get('products/{slug}', [ProductController::class, 'show'])->name('front.products.show');
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('dash', function () {
//     return view('dashboard');

// })->middleware('auth');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// Route::post('/paypal/webhook', function () {
//     echo "webhook called successfully" ;
// });
Route::resource('cart', CartController::class)->middleware('auth');
Route::get('/delete-cart-product/{id}', [CartController::class, 'deleteProduct'])->name('delete.cart.product');


require __DIR__ . '/auth.php';
require __DIR__ . '/dashboard.php';