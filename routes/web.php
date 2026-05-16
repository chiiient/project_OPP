<?php

<<<<<<< HEAD
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Admin\CategoryController; // Pastikan ini di-import

// Halaman Awal User Biasa
Route::get('/', function () { 
    return view('welcome'); 
});

// Grup Route untuk Admin Kontrol Semua Pesanan & Produk
Route::prefix('admin')->group(function () {
    // Dashboard Utama Admin
    Route::get('/dashboard', [OrderController::class, 'dashboard'])->name('admin.dashboard');
    
    // CRUD Kategori (Otomatis membuat route index, create, store, edit, update, destroy)
    Route::resource('categories', CategoryController::class);
    
    // CRUD Produk Pizza
    Route::resource('products', ProductController::class);
    
    // Kontrol Pesanan/Orderan Pizza
    Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('admin.orders.show');
    Route::patch('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.update');
});
=======
Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
Route::get('/orders/list', [OrderController::class, 'show_all'])->name('orders.list');
Route::get('/orders/detail/{id}', [OrderController::class, 'show'])->name('orders.show');
Route::patch('/orders/pay/{id}', [OrderController::class, 'markAsPaid'])->name('orders.pay');


Route::get('/', function () {
    return view('welcome');
})->name('home');
>>>>>>> b653dc537ba58329e120a6967fb939a5974cf7c0
