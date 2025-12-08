<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Carts\Controllers\CartController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('users', App\Modules\Users\Controllers\UserController::class);

// Ver carrito
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

// Agregar al carrito
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');

// Actualizar cantidad
Route::put('/cart/{cartItemId}', [CartController::class, 'update'])->name('cart.update');

// Eliminar item
Route::delete('/cart/{cartItemId}', [CartController::class, 'remove'])->name('cart.remove');

// Vaciar carrito
Route::delete('/cart', [CartController::class, 'clear'])->name('cart.clear');

// Resumen del carrito (AJAX)
Route::get('/cart/summary', [CartController::class, 'summary'])->name('cart.summary');
