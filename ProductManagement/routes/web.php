<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;

Route::get('/', [ProductsController::class, 'index'])->name('index');
Route::get('/products/data', [ProductsController::class, 'data'])->name('products.data');
Route::post('/products', [ProductsController::class, 'store'])->name('products.store');
Route::get('/{product}/edit', [ProductsController::class, 'edit'])->name('products.edit');
Route::put('/{product}', [ProductsController::class, 'update'])->name('products.update');
Route::delete('/{product}', [ProductsController::class, 'destroy'])->name('products.destroy');