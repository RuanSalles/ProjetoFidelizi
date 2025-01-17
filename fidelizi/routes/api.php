<?php

use App\Http\Controllers\AwardController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\BearerTokenMiddleware;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/awards', [AwardController::class, 'index']);
Route::get('/users', [UserController::class, 'index']);
Route::get('/awards/{id}', [AwardController::class, 'show']);
Route::get('fidelityActiveUsers', [UserController::class, 'getActiveFidelityUsers']);
Route::get('/activeUserFidelityProgram/{id}', [UserController::class, 'activeUserFidelityProgram']);


