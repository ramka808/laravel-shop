<?php

use Illuminate\Support\Facades\Auth;
Use Illuminate\Support\Facades\Route;
Use App\Http\Controllers\CatalogController;
Use App\Http\Controllers\BasketController;
Use App\Http\Controllers\UserController;
Use App\Http\Controllers\Admin\IndexController;
Use Laravel\Ui\AuthRouteMethods;

//Use App\Http\Controllers\IndexController;

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
    return view('index');
});

Route::get('/', [\App\Http\Controllers\IndexController::class, '__invoke'])->name('index');


Route::get('/catalog/index', [CatalogController::class, 'index'])->name('catalog.index');
Route::get('/catalog/category/{slug}', [CatalogController::class, 'category'])
    ->name('catalog.category');
Route::get('/catalog/brand/{slug}', [CatalogController::class, 'brand'])->name('catalog.brand');
Route::get('/catalog/product/{slug}', [CatalogController::class, 'product'])->name('catalog.product');

Route::get('/basket/index', [BasketController::class, 'index'])->name('basket.index');
Route::get('/basket/checkout', [BasketController::class, 'checkout'])->name('basket.checkout');

Route::post('/basket/add/{id}', [BasketController::class, 'add'])
    ->where('id', '[0-9]+')
    ->name('basket.add');
Route::post('/basket/plus/{id}', [BasketController::class, 'plus'])
    ->where('id', '[0-9]+')
    ->name('basket.plus');
Route::post('/basket/minus/{id}', [BasketController::class, 'minus'])
    ->where('id', '[0-9]+')
    ->name('basket.minus');
Route::post('/basket/remove/{id}', [BasketController::class, 'remove'])
    ->where('id', '[0-9]+')
    ->name('basket.remove');
Route::post('/basket/clear', [BasketController::class, 'clear'])->name('basket.clear');


Route::name('user.')->prefix('user')->group(function () {
    Route::get('index', [UserController::class,'index'])->name('index');
    Auth::routes();
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// первый способ добавления посредников
Route::namespace('Admin')->name('admin.')->prefix('admin')->middleware('auth', 'admin')->group(function () {
    Route::get('index', [IndexController::class, 'index'])->name('index');
});
