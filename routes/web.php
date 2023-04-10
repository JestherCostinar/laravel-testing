<?php

use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
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

Route::redirect('/', 'login');

Route::middleware('auth')->group(function () {
  Route::get('/products', [ProductsController::class, 'index'])->name('products.index');

  Route::middleware(('is_admin'))->group(function () {
    Route::get('products/create', [ProductsController::class, 'create'])->name('products.create');
    Route::post('products', [ProductsController::class, 'store'])->name('products.store');
    Route::get('products/{product}/edit/', [ProductsController::class, 'edit'])->name('products.edit');
    Route::put('products/{product}', [ProductsController::class, 'update'])->name('products.update');
  });
});


require __DIR__ . '/auth.php';
