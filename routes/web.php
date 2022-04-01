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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/api/products', [App\Http\Controllers\ProductController::class, 'show_products'])->name('product.show');
Route::get('/api/products/recommendation/{city}', [App\Http\Controllers\ProductController::class, 'product_recommend'])->name('product.recommend');
