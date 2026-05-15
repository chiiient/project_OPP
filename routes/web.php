<?php

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