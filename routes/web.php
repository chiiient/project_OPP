<?php
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;

// Ini akan otomatis membuat semua rute untuk CRUD (index, create, store, edit, update, destroy)
Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
Route::get('/orders/list', [OrderController::class, 'show_all'])->name('orders.list');
Route::get('/orders/detail/{id}', [OrderController::class, 'show'])->name('orders.show');
Route::get('/orders/pay/{id}', [OrderController::class, 'markAsPaid'])->name('orders.pay');


Route::get('/', function () {
    return view('welcome');
});
