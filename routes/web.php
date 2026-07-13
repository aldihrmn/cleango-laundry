<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Services list for all authenticated users
    Route::get('/services', [ServiceController::class, 'index'])
        ->name('services.index');

    // Service management only for admin
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/services/create', [ServiceController::class, 'create'])
            ->name('services.create');
        Route::post('/services', [ServiceController::class, 'store'])
            ->name('services.store');
        Route::get('/services/{service}/edit', [ServiceController::class, 'edit'])
            ->name('services.edit');
        Route::put('/services/{service}', [ServiceController::class, 'update'])
            ->name('services.update');
        Route::delete('/services/{service}', [ServiceController::class, 'destroy'])
            ->name('services.destroy');
    });

    // Service show for all authenticated users
    Route::get('/services/{service}', [ServiceController::class, 'show'])
        ->name('services.show');

    // Orders list for all authenticated users
    Route::get('/orders', [OrderController::class, 'index'])
        ->name('orders.index');

    // Order create/store only for customer
    Route::middleware(['role:customer'])->group(function () {
        Route::get('/orders/create', [OrderController::class, 'create'])
            ->name('orders.create');
        Route::post('/orders', [OrderController::class, 'store'])
            ->name('orders.store');

        Route::get('/orders/{order}/payment', [PaymentController::class, 'checkout'])
            ->name('orders.payment');
        Route::post('/orders/{order}/payment', [PaymentController::class, 'processCheckout'])
            ->name('orders.payment.process');
        Route::get('/orders/{order}/payment/qris/{payment}', [PaymentController::class, 'qris'])
            ->name('orders.payment.qris');
        Route::post('/orders/{order}/payment/qris/{payment}', [PaymentController::class, 'confirmQris'])
            ->name('orders.payment.qris.confirm');
        Route::get('/orders/{order}/payment/success', [PaymentController::class, 'success'])
            ->name('orders.payment.success');
    });

    // Order edit/update/destroy only for admin
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('orders', OrderController::class)
            ->except(['index', 'create', 'store']);
    });

    // Payments
    Route::resource('payments', PaymentController::class);

    // Reports
    Route::resource('reports', ReportController::class)
        ->only(['index']);

    // Export PDF
    Route::get('/reports/pdf', [ReportController::class, 'exportPdf'])
        ->name('reports.pdf');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__ . '/auth.php';
