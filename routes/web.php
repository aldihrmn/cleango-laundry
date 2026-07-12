<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ReportController;
use App\Http\Middleware\CustomerOnly;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
    // Orders
    Route::resource('orders', OrderController::class);
    // Service
    Route::resource('services', ServiceController::class);

    // Checkout
    Route::middleware([CustomerOnly::class])->group(function () {
        Route::get('/orders/{order}/checkout', [CheckoutController::class, 'checkout'])
            ->name('checkout.index');
        Route::post('/orders/{order}/checkout', [CheckoutController::class, 'pay'])
            ->name('checkout.pay');
        Route::get('/orders/{order}/checkout/qris', [CheckoutController::class, 'qris'])
            ->name('checkout.qris');
        Route::post('/orders/{order}/checkout/confirm', [CheckoutController::class, 'confirm'])
            ->name('checkout.confirm');
        Route::get('/orders/{order}/checkout/success', [CheckoutController::class, 'success'])
            ->name('checkout.success');
    });

    // Payments
    Route::resource('payments', PaymentController::class)
        ->except(['create', 'store', 'edit', 'update']);

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
