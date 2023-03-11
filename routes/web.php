<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductVariantController;
use Illuminate\Support\Facades\Auth;

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

Route::resource('users', \App\Http\Controllers\UserController::class)
    ->middleware('auth');

Route::get('/home', function () {
    return view('home');
})->name('home')->middleware('auth');

Route::resource('/categories', CategoryController::class)->middleware('auth');
Route::resource('/products', ProductController::class)->middleware('auth');
Route::resource('/products_variants', ProductVariantController::class)->middleware('auth');

// Route::resources([
//     "categories" => CategoryController::class,
//     "products" => ProductController::class
// ]);
