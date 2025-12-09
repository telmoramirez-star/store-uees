<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Modules\Carts\Controllers\CartController;

Route::middleware(["auth"])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/{cartItemId}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{cartItemId}', [CartController::class, 'remove'])->name('cart.remove');
    Route::delete('/cart', [CartController::class, 'clear'])->name('cart.clear');
    Route::get('/cart/summary', [CartController::class, 'summary'])->name('cart.summary');
    Route::post('logout', [App\Modules\Login\Controllers\LoginController::class, 'logout'])->name('logout');
    Route::get('/', function () {
        return redirect()->route('products.index');
    });
    
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    
    Route::resource('users', App\Modules\Users\Controllers\UserController::class)->middleware(\App\Http\Middleware\CheckAdmin::class);
});

Route::get('login', [App\Modules\Login\Controllers\LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [App\Modules\Login\Controllers\LoginController::class, 'login']);