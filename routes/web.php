<?php

use App\Http\Controllers\Api\OrdersController;
use App\Http\Controllers\AuthLoginController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('products', 'App\Http\Controllers\ProductController');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/shop', 'App\Http\Controllers\ProductController@shop')->name('shop');
    Route::get('/search', 'App\Http\Controllers\ProductController@search')->name('search');
    Route::get('/about', 'App\Http\Controllers\ProductController@about')->name('about');
    Route::get('/shop/bag/{id}', 'App\Http\Controllers\ProductController@bag')->name('bag');

    Route::post('/orders', [OrdersController::class, 'index'])->name('orders.index');
    Route::post('/logout', [AuthLoginController::class, 'logout'])->name('logout');
    Route::get('/orders/add-to-cart', [OrdersController::class, 'getCountOrders']);
    Route::get('/orders/add-to-cart/{id}', [OrdersController::class, 'addToCart'])->name('addToCart');
});

Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login')->withoutMiddleware(['auth']);
Auth::routes(['register' => true]);

Auth::routes();
