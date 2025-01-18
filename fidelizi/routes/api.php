<?php

use App\Http\Controllers\AwardController;
use App\Http\Controllers\BalanceController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\RescueAwardController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/customers/{id}/activate', [CustomerController::class, 'activateCustomer'])->middleware(['auth:sanctum', 'abilities:client-create']);
    Route::get('/customers/{id}/deactivate', [CustomerController::class, 'deactivateCustomer'])->middleware(['auth:sanctum', 'abilities:client-create']);
    Route::get('/customers', [CustomerController::class, 'index'])->middleware(['auth:sanctum', 'abilities:client-index']);
    Route::get('/customers/{id}', [CustomerController::class, 'show'])->middleware(['auth:sanctum', 'abilities:client-show']);
    Route::post('/customers', [CustomerController::class, 'store']);
    Route::get('/customers/{id}/balance', [BalanceController::class, 'reportBalance'])->middleware(['auth:sanctum', 'abilities:point-index']);
    Route::get('/customers/{id}/get-points', [CustomerController::class, 'getPoints'])->middleware(['auth:sanctum', 'abilities:balance-get']);
    Route::put('/customers/{id}/add-points', [CustomerController::class, 'addPoints']);
    Route::put('/customers/{id}/debit-points', [CustomerController::class, 'debitPoints']);
    Route::get('/awards', [AwardController::class, 'index']);
    Route::get('/awards/{id}', [AwardController::class, 'show']);
    Route::post('/transactions', [TransactionController::class, 'store'])->middleware(['auth:sanctum', 'abilities:point-create']);
    Route::get('/balances', [BalanceController::class, 'index'])->middleware(['auth:sanctum', 'abilities:point-index']);
    Route::get('/balances/list-for-customer/{id}', [BalanceController::class, 'balanceListForCustomer'])->middleware(['auth:sanctum', 'abilities:point-index']);
    Route::post('/rescue-awards', [RescueAwardController::class, 'store']);
});




