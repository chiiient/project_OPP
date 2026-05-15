<?php
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    $products = Product::with('category')
        ->where('is_available', true)
        ->latest()
        ->get();

    return view('welcome', compact('products'));
})->name('home');

Route::get('/order', [OrderController::class, 'clientIndex'])->name('client.orders.index');
Route::post('/order', [OrderController::class, 'clientStore'])->name('client.orders.store');
Route::get('/order/success/{id}', [OrderController::class, 'clientSuccess'])->name('client.orders.success');

Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.store');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->middleware('auth')->name('admin.logout');

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::resource('products', ProductController::class)->except(['show']);
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/list', [OrderController::class, 'show_all'])->name('orders.list');
    Route::get('/orders/detail/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/pay/{id}', [OrderController::class, 'markAsPaid'])->name('orders.pay');
});
