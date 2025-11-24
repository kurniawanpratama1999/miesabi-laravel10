<?php

use App\Http\Controllers\Guest\{LoginController, RegisterController};
use App\Http\Controllers\Admin\{CategoryController, DeliveryController, VariantController, ProductController, OrderController as AdminOrderController};
use App\Http\Controllers\User\{MenuController, CartController, CheckoutController,ScanQrController, OrderController as UserOrderController, OrderDetailController as UserOrderDetailController};
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

            Route::put('/u/orders/payment/{order_id}', [AdminOrderController::class, 'updatePaymentStatus'])
            ->whereNumber('order_id')
            ->name('u.orders.payment');

            Route::put('/u/orders/status/{order_id}/next', [AdminOrderController::class, 'updateOrderStatus'])
            ->whereNumber('order_id')
            ->name('u.orders.status.next');

            Route::put('/u/orders/status/{order_id}/prev', [AdminOrderController::class, 'rollbackOrderStatus'])
            ->whereNumber('order_id')
            ->name('u.orders.status.prev');

            Route::resource('orders', AdminOrderController::class);
            
            Route::resource('details', ProductController::class);
        });
    });
    
    Route::middleware(['checkrole:user'])->group(function () {
        Route::prefix('u')->group(function(){
            Route::resource('menu', MenuController::class);
            Route::resource('cart', CartController::class);
            Route::resource('checkout', CheckoutController::class);
            Route::resource('scanqr', ScanQrController::class);
            Route::resource('orders', UserOrderController::class);
            Route::resource('details', UserOrderDetailController::class);
        });
    });
});
