<?php

use App\Http\Controllers\Customer\AccountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Merchant\MenuController;
use App\Http\Controllers\Merchant\MerchantController;
use App\Http\Controllers\Merchant\OrderController;
use App\Http\Controllers\Merchant\ProfileController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\OrderController as OrderCustomer;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// customer
Route::post('/loginUser', [AuthController::class, 'login'])->name('login.user');
Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'customer'])->group(function () {
    // account
    Route::prefix('account')->group(function () {
        Route::get('/profile', [AccountController::class, 'index']);
        Route::post('/save', [AccountController::class, 'save'])->name('account.save');
    });

    // cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::get('/cartTotal', [CartController::class, 'cartTotal'])->name('cartTotal');
    Route::post('/saveCart', [CartController::class, 'cart'])->name('saveCart');
    Route::post('/addQtyCart', [CartController::class, 'addQtyCart'])->name('addQtyCart');
    Route::post('/removeCart', [CartController::class, 'removeCart'])->name('removeCart');
    Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

    // order
    Route::get('/customer-order', [OrderCustomer::class, 'index']);
});

// merchant
Route::get('/merchant', function() {
    return redirect('merchant/profile');
});

Route::get('/admin', function() {
    return redirect('merchant');
});

Route::prefix('merchant')
    ->middleware(['auth', 'merchant'])
    ->group(function () {
        // profile owner
        Route::prefix('profile')->group(function () {
            Route::get('/', [ProfileController::class, 'index']);
            Route::post('/update', [ProfileController::class, 'update'])->name('profile.update');
        });

        // merchant
        Route::post('/update', [MerchantController::class, 'update'])->name('merchant.update');

        // menu
        Route::resource('menu', MenuController::class);

        // customer
        // Route::resource('customer', CustomerController::class);

        // order
        Route::resource('order', OrderController::class);
        Route::get('/order/complete/{id}', [OrderController::class, 'complete']);
});

Route::get('/print-invoice', [OrderCustomer::class, 'print']);
