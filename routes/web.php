<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Carts\Controllers\CartController;

Route::middleware(["auth"])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/{cartItemId}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{cartItemId}', [CartController::class, 'remove'])->name('cart.remove');
    Route::delete('/cart', [CartController::class, 'clear'])->name('cart.clear');
    Route::get('/cart/summary', [CartController::class, 'summary'])->name('cart.summary');
    Route::post('/checkout', [App\Modules\Orders\Controllers\OrderController::class, 'store'])->name('orders.store');
    Route::post('logout', [App\Modules\Login\Controllers\LoginController::class, 'logout'])->name('logout');
    Route::get('/', function () {
        return redirect()->route('products.index');
    });
    
    Route::get('/products', [App\Modules\Products\Controllers\ProductController::class, 'index'])->name('products.index');
    
    Route::middleware([\App\Http\Middleware\CheckAdmin::class])->group(function () {
        Route::post('/products', [App\Modules\Products\Controllers\ProductController::class, 'store'])->name('products.store');
        Route::resource('users', App\Modules\Users\Controllers\UserController::class);
        Route::get('/logs', [App\Modules\Logs\Controllers\LogController::class, 'index'])->name('logs.index');
        Route::patch('/users/{id}/toggle', [App\Modules\Users\Controllers\UserController::class, 'toggleStatus'])->name('users.toggle');
        Route::get('/products/import', [App\Modules\Products\Controllers\ProductController::class, 'importView'])->name('products.import.view');
        Route::post('/products/import', [App\Modules\Products\Controllers\ProductController::class, 'import'])->name('products.import.store');
        Route::get('/orders', [App\Modules\Orders\Controllers\OrderController::class, 'index'])->name('orders.index');
    });
});

Route::get('login', [App\Modules\Login\Controllers\LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [App\Modules\Login\Controllers\LoginController::class, 'login']);