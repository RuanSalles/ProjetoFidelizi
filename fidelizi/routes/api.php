<?php

use App\Http\Controllers\AwardController;
use App\Http\Controllers\BalanceController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\RescueAwardController;
use App\Http\Controllers\TransactionController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\PersonalAccessToken;

Route::post('/login', function (Request $request) {

    $credentials = $request->only('email', 'password');

    if(Auth::attempt($credentials)) {
        $user = $request->user();
        return response()->json([
            'user' => $user,
            'token' => $user->tokens()->pluck('name')->first(),
        ]);
    }

    return response(json_encode([
        'status' => 'error',
        'message' => 'Usuário inválido',
    ]), 404);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/customers/{id}/activate', [CustomerController::class, 'activateCustomer'])->middleware(['auth:sanctum', 'abilities:client-create']);
    Route::get('/customers/{id}/deactivate', [CustomerController::class, 'deactivateCustomer'])->middleware(['auth:sanctum', 'abilities:client-create']);
    Route::get('/customers', [CustomerController::class, 'index'])->middleware(['auth:sanctum', 'abilities:client-index'])->middleware(['auth:sanctum', 'abilities:client-index']);
    Route::get('/customers/{id}', [CustomerController::class, 'show'])->middleware(['auth:sanctum', 'abilities:client-show'])->middleware(['auth:sanctum', 'abilities:client-show']);
    Route::post('/customers', [CustomerController::class, 'store'])->middleware('permission:client-create');
    Route::get('/customers/{id}/balance', [BalanceController::class, 'reportBalance'])->middleware(['auth:sanctum', 'abilities:point-index']);
    Route::get('/customers/{id}/get-points', [CustomerController::class, 'getPoints'])->middleware(['auth:sanctum', 'abilities:balance-get']);
    Route::put('/customers/{id}/add-points', [CustomerController::class, 'addPoints'])->middleware(['auth:sanctum', 'abilities:client-create']);
    Route::put('/customers/{id}/debit-points', [CustomerController::class, 'debitPoints'])->middleware(['auth:sanctum', 'abilities:client-create']);
    Route::get('/awards', [AwardController::class, 'index'])->middleware(['auth:sanctum', 'abilities:client-create']);
    Route::get('/awards/{id}', [AwardController::class, 'show'])->middleware(['auth:sanctum', 'abilities:client-create']);
    Route::post('/transactions', [TransactionController::class, 'store'])->middleware(['auth:sanctum', 'abilities:point-create']);
    Route::get('/transactions', [TransactionController::class, 'index'])->middleware(['auth:sanctum', 'abilities:point-create']);
    Route::get('/balances', [BalanceController::class, 'index'])->middleware(['auth:sanctum', 'abilities:point-index']);
    Route::get('/balances/list-for-customer/{id}', [BalanceController::class, 'balanceListForCustomer'])->middleware(['auth:sanctum', 'abilities:point-index']);
    Route::post('/rescue-awards', [RescueAwardController::class, 'store'])->middleware('auth:sanctum', 'abilities:prize-get');
    Route::get('/rescue-awards', [RescueAwardController::class, 'index'])->middleware('auth:sanctum', 'abilities:prize-get');
});




