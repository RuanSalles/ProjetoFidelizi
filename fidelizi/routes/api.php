<?php

use App\Http\Controllers\AwardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\BearerTokenMiddleware;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;



Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/awards', [AwardController::class, 'index']);
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/awards/{id}', [AwardController::class, 'show']);
    Route::get('fidelityActiveUsers', [UserController::class, 'getUsersActiveFidelityUsers']);
    Route::get('/activeUserFidelityProgram/{id}', [UserController::class, 'activeUserFidelityProgram']);
    Route::apiResource('/customers', CustomerController::class);
    Route::get('customers/getPoints/{id}', [CustomerController::class, 'getPoints']);
    Route::put('customers/addPoints/{id}', [CustomerController::class, 'addPoints']);
    Route::put('customers/debitPoints/{id}', [CustomerController::class, 'debitPoints']);
});




