<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
Route::get('/products/sort/name', [ProductController::class, 'sortByName'])->name('products.sort.name');
Route::get('/products/sort/price', [ProductController::class, 'sortByPrice'])->name('products.sort.price');
Route::resource('/products', ProductController::class);
