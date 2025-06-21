<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MasterDataController;

Route::get('/events', [MasterDataController::class, 'events']);
Route::get('/payment-methods', [MasterDataController::class, 'paymentMethods']);
Route::get('/companies', [MasterDataController::class, 'companies']);
Route::get('/payment-provider-requests', [MasterDataController::class, 'paymentProviderRequests']);
