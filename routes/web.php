<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Authentication routes (handled by Breeze)
require __DIR__.'/auth.php';

// Protected routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Admin routes
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/customers', [AdminController::class, 'customers'])->name('customers');
        Route::get('/customers/{customer}', [AdminController::class, 'showCustomer'])->name('customers.show');
        Route::get('/customers/{id}/edit', [AdminController::class, 'editCustomer'])->name('customers.edit');
        Route::put('/customers/{id}', [AdminController::class, 'updateCustomer'])->name('customers.update');
        Route::delete('/customers/{customer}', [AdminController::class, 'deleteCustomer'])->name('customers.destroy');
        
        // Product management
        Route::resource('products', ProductController::class);
        Route::resource('orders', App\Http\Controllers\Admin\OrderController::class);
        
        // Reports route
        Route::get('/reports', [AdminController::class, 'reports'])->name('reports.index');
    });

    // Customer routes
    Route::middleware(['role:customer'])->prefix('customer')->name('customer.')->group(function () {
        Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('dashboard');
        Route::get('/profile', [CustomerController::class, 'profile'])->name('profile');
        Route::put('/profile', [CustomerController::class, 'updateProfile'])->name('profile.update');
        Route::put('/password', [CustomerController::class, 'updatePassword'])->name('password.update');
        Route::get('/orders', [CustomerController::class, 'orders'])->name('orders.index');
    });

    // Product routes (accessible by both admin and customer)
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

    // Profile routes (Breeze default)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Cart routes
    Route::post('/cart/{product}', [App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
});
