<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventPaymentController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\PaymentProviderRequestController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\FinanceMiddleware;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

// Finance routes
Route::middleware(['auth','verified', FinanceMiddleware::class])
->prefix('finance')
->name('finance.')
->group(function () {
    Route::get('/dashboard', [FinanceController::class, 'index'])->name('dashboard');
    Route::get('/event/{id}/edit', [FinanceController::class, 'editPayment'])->name('edit');
    Route::post('/event/{id}/update', [FinanceController::class, 'updatePayment'])->name('update');

    Route::get('/request-provider', [PaymentProviderRequestController::class, 'requestPaymentProvider'])->name('request-provider');
    Route::get('/create-request-provider', [PaymentProviderRequestController::class, 'createRequestPaymentProvider'])->name('create-request-provider');
    Route::post('/store-provider-request', [PaymentProviderRequestController::class, 'storePaymentProviderRequest'])->name('store-provider-request');
    Route::put('/provider-requests/{id}/status', [PaymentProviderRequestController::class, 'updateStatus'])->name('provider-requests.update-status');
    
    Route::get('/event-payments', [EventPaymentController::class, 'eventPayment'])->name('event-payments');
    Route::get('/event-payments/{id}/edit', [EventPaymentController::class, 'edit'])->name('event-payments.edit');
    Route::put('/event-payments/{id}', [EventPaymentController::class, 'update'])->name('event-payments.update');
});

Route::middleware(['auth','verified'])
->prefix('profile')
->name('profile.')
->group(function () {
    Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
    Route::post('/update', [ProfileController::class, 'update'])->name('update');
});