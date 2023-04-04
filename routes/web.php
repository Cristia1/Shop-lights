<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\LightController;
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
    Route::resource('lights', 'App\Http\Controllers\LightController');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/', 'App\Http\Controllers\LightController@home')->name('home');
    Route::get('/shop', 'App\Http\Controllers\LightController@shop')->name('shop');
    Route::get('/shop/bag/{id}', 'App\Http\Controllers\LightController@bag')->name('bag');
    Route::get('/search', 'App\Http\Controllers\LightController@search')->name('search');
    Route::get('/about', 'App\Http\Controllers\LightController@about')->name('about');
    Route::get('/cart', [CardController::class, 'show'])->name('cart.show');

    Route::get('/shop/bag/{id}', [lightController::class, 'bag'])->name('bag');
});
Route::post('/cart/add', [CardController::class, 'add'])->name('cart.add');
Route::post('/cart/add', 'CartController@addToCart')->name('cart.add');
Route::post('/cart/remove', 'CartController@removeFromCart')->name('cart.remove');
Route::get('/cart', [CardControler::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CardControler::class, 'addToCart'])->name('cart.add');
Route::post('/cart/remove', [CardControler::class, 'removeFromCart'])->name('cart.remove');

Route::get('/login', [LightController::class, 'index'])->name('login')->withoutMiddleware(['auth']);

Auth::routes();
