<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart');
Route::post('/add-to-cart', [App\Http\Controllers\CartController::class, 'addToCart'])->name('addToCart');
Route::post('/remove-from-cart', [App\Http\Controllers\CartController::class, 'removeFromCart'])->name('removeFromCart');
Route::post('/update-cart', [App\Http\Controllers\CartController::class, 'updateCart'])->name('updateCart');
Route::get('/shop', [App\Http\Controllers\ShopController::class, 'index'])->name('shop');
Route::get('/products/{product}', [App\Http\Controllers\ShowController::class, 'index'])->name('product.show');

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', \App\Http\Controllers\Admin\Main\IndexController::class)->name('admin.main.index');

    Route::group(['prefix' => 'products'], function () {
        Route::get('/', \App\Http\Controllers\Admin\Product\IndexController::class)->name('admin.product.index');
        Route::post('/', \App\Http\Controllers\Admin\Product\StoreController::class)->name('admin.product.store');
    });
});
