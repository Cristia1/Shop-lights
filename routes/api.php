<?php

use App\Http\Controllers\Api\OrdersController;
use Illuminate\Support\Facades\Route;

Route::get('/orders', [OrdersController::class, 'index'])->name('orders.index');
Route::get('/orders/{id}', [OrdersController::class, 'show'])->name('orders.show');
Route::post('/orders', [OrdersController::class, 'store'])->name('orders.store');
Route::put('/orders/{id}', [OrdersController::class, 'update'])->name('orders.update');
Route::delete('/orders/{id}', [OrdersController::class, 'destroy'])->name('orders.destroy');
Route::put('/api/orders/add-to-cart', 'App\Http\Controllers\Api\OrdersController@addToCart')->middleware('auth');

Route::post('/payment/card', [OrdersController::class, 'card'])->name('payment.card');

Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login')->withoutMiddleware(['auth']);
Auth::routes(['register' => true]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
