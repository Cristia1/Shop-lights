<?php

    use App\Http\Controllers\Api\OrdersController;
    use Illuminate\Support\Facades\Route;

    /*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register API routes for your application.
    | These routes are loaded by the RouteServiceProvider within a group which
    | is assigned the "api" middleware group. Enjoy building your API!
    |
    */

    Route::get('/orders', [OrdersController::class, 'index'])->name('api.orders.index');
    Route::post('/orders/', [OrdersController::class, 'store'])->name('api.orders.store');
    Route::put('/orders/{id}', [OrdersController::class, 'update'])->name('api.orders.update');
    Route::delete('/orders/{id}', [OrdersController::class, 'destroy'])->name('api.orders.destroy');
    Route::post('/orders/add-to-cart', [OrdersController::class, 'addToCart'])->name('api.orders.addToCart');
