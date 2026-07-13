<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ServiceController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth:sanctum');
Route::get('/services', [ServiceController::class, 'index'])->middleware('auth:sanctum');

Route::post('/orders', [OrderController::class, 'store'])->middleware('auth:sanctum');
Route::get('/orders', [OrderController::class, 'index'])->middleware('auth:sanctum');
Route::get('/orders/{id}', [OrderController::class, 'show'])->middleware('auth:sanctum');
Route::patch('/orders/{id}/status', [OrderController::class, 'updateStatus'])->middleware('auth:sanctum');
Route::post('/orders/{id}/payment', [OrderController::class, 'pay'])->middleware('auth:sanctum');
Route::patch('/orders/{id}/payment/confirm', [OrderController::class, 'confirmPayment'])->middleware('auth:sanctum');
