<?php

use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\Front\Auth\TwoFactorController;
use App\Http\Controllers\front\CartController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


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

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::get('ld', [HomeController::class, 'cart_shop'])->name('cart_shop');
        Route::get('/products', [ProductController::class, 'index'])->name('front.products.index');
        Route::get('products/{slug}', [ProductController::class, 'show'])->name('front.products.show');
        Route::get('Auth/2FA', [TwoFactorController::class, 'index'])->name('2FA');
        Route::middleware('auth',)->group(function () {
            Route::get('notify/{id}', [HomeController::class, 'markasread'])->name('notify.read');
            Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
            Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        });
        // Route::post('/paypal/webhook', function () {
        //     echo "webhook called successfully" ;
        // });
        Route::resource('cart', CartController::class)->middleware('auth');
        Route::get('/delete-cart-product/{id}', [CartController::class, 'destroy'])->name('delete.cart.product');

        Route::get('checkout', [CheckoutController::class, 'create'])->name('checkout');
        Route::post('checkout/store', [CheckoutController::class, 'store'])->name('checkout.store');
    }

);
Route::get('auth/{provider}/redirect', [SocialLoginController::class, 'redirect'])->name('auth.redirect');
Route::get('auth/{provider}/callback', [SocialLoginController::class, 'callback'])->name('auth.callback');

// require __DIR__ . '/auth.php';
require __DIR__ . '/dashboard.php';