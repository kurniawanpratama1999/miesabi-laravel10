<?php

use App\Http\Controllers\Guest\{LoginController, RegisterController};
use App\Http\Controllers\{CategoryController, DeliveryController, VariantController, ProductController};
use App\Http\Controllers\User\{MenuController, KeranjangController, CheckoutController, OrderController as UserOrderController, ScanQrController};
use Illuminate\Support\Facades\Route;

Route::middleware(['redirectifloggedin'])->group(function () {
    Route::get('/', [MenuController::class, 'index']);
    
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.process');
    
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.process');
});

Route::delete('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {

    Route::middleware(['checkrole:admin'])->group(function () {
        Route::prefix('a')->group(function () {
            Route::resource('categories', CategoryController::class);
            Route::resource('deliveries', DeliveryController::class);
            Route::resource('variants', VariantController::class);
            Route::resource('products', ProductController::class);
            Route::resource('orders', ProductController::class);
            Route::resource('details', ProductController::class);
        });
    });
    
    Route::middleware(['checkrole:user'])->group(function () {
        Route::prefix('u')->group(function(){
            Route::resource('menu', MenuController::class);
            Route::resource('cart', KeranjangController::class);
            Route::resource('checkout', CheckoutController::class);
            Route::resource('scanqr', ScanQrController::class);
            Route::resource('orders', UserOrderController::class);
            Route::resource('details', UserOrderController::class);
        });
    });
});
