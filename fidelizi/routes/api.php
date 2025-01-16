<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');
    if (auth()->attempt($credentials)) {
        $user = $request->user();
        $user->tokens()->delete();


        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    return response()->json(['error' => 'Unauthorized'], 401);

});

Route::post('teste', function (Request $request) {
    $user = User::all();

    return response()->json($user, 200);
});
