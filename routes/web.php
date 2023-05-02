<?php

use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductController;
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

    Route::get('/orders', [OrdersController::class, 'index'])->name('orders.index');
    Route::put('/orders/{id}/update', [OrdersController::class, 'update'])->name('orders.update');
    Route::delete('/orders/{id}', [OrdersController::class, 'destroy'])->name('orders.destroy');
    Route::get('/orders/{order}', [OrdersController::class, 'show'])->name('orders.show');
    Route::post('orders', [App\Http\Controllers\OrdersController::class, 'store'])->name('orders.store');
});

Route::get('/login', [ProductController::class, 'index'])->name('login')->withoutMiddleware(['auth']);
Auth::routes(['register' => true]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
