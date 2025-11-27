<?php

use App\Http\Controllers\Guest\{LoginController, RegisterController};
use App\Http\Controllers\Admin\{CategoryController, DeliveryController, VariantController, ProductController, OrderController as AdminOrderController, OrderDetailController as AdminOrderDetailController,ReviewController as AdminReviewController, UserController, BarcodeController, LogoController};
use App\Http\Controllers\User\{MenuController, CartController, CheckoutController, ScanQrController, OrderController as UserOrderController, OrderDetailController as UserOrderDetailController, ReviewController as UserReviewController};
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
        Route::prefix('a')->name('a.')->group(function () {
            Route::resource('users', UserController::class);
            Route::resource('categories', CategoryController::class);
            Route::resource('deliveries', DeliveryController::class);
            Route::resource('variants', VariantController::class);
            Route::resource('products', ProductController::class);

            Route::put('/orders/payment/{order_id}/next', [AdminOrderController::class, 'updatePaymentStatus'])
                ->whereNumber('order_id')
                ->name('orders.payment.next');

            Route::put('/orders/payment/{order_id}/prev', [AdminOrderController::class, 'rollbackPaymentStatus'])
                ->whereNumber('order_id')
                ->name('orders.payment.prev');

            Route::put('/orders/status/{order_id}/next', [AdminOrderController::class, 'updateOrderStatus'])
                ->whereNumber('order_id')
                ->name('orders.status.next');

            Route::put('/orders/status/{order_id}/prev', [AdminOrderController::class, 'rollbackOrderStatus'])
                ->whereNumber('order_id')
                ->name('orders.status.prev');

            Route::resource('orders', AdminOrderController::class);

            Route::resource('details', AdminOrderDetailController::class);
            Route::resource('reviews', AdminReviewController::class);
            Route::resource('barcode', BarcodeController::class);
            Route::resource('logo', LogoController::class);
        });
    });

    Route::middleware(['checkrole:user'])->group(function () {
        Route::prefix('u')->name('u.')->group(function () {
            Route::resource('menu', MenuController::class);
            Route::resource('cart', CartController::class);
            Route::resource('checkout', CheckoutController::class);
            Route::resource('scanqr', ScanQrController::class);
            Route::resource('orders', UserOrderController::class);
            Route::resource('details', UserOrderDetailController::class);
            Route::resource('reviews', UserReviewController::class);
        });
    });
});
