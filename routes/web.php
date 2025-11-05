<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\POSController;
use App\Http\Controllers\OrderHistoryController; // Import the new controller
use App\Http\Controllers\AdminDashboardController; // Import the new controller
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [AdminDashboardController::class, 'index'])
    ->middleware(['auth', 'verified', 'can:dashboard'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // POS Routes
    Route::get('/pos', [POSController::class, 'index'])->name('pos.index');
    Route::get('/api/products/{id}', [POSController::class, 'getProduct']);
    Route::post('/api/sales', [POSController::class, 'processSale']);
});

// Receipt Route
Route::get('/pos/receipt/{sale}', [POSController::class, 'showReceipt'])->name('pos.receipt');

// Order History Route
Route::middleware(['auth'])->group(function () {
    Route::get('/history-order', [OrderHistoryController::class, 'index'])->name('history-order.index');
});

Route::middleware(['auth', 'can:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
    Route::resource('sales', \App\Http\Controllers\Admin\SaleController::class);
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    Route::resource('settings', \App\Http\Controllers\Admin\SettingController::class)->middleware('can:manage settings');
});

require __DIR__ . '/auth.php';
