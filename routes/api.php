<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIGuruController;
use App\Http\Controllers\APIIndustriController;
use App\Http\Controllers\APISiswaController;
use App\Http\Controllers\APIPklController;
use Illuminate\Support\Facades\Auth;

Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');

    if (!Auth::attempt($credentials)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    $user = Auth::user();
    $token = $user->createToken('api-token')->plainTextToken;

    return response()->json([
        'access_token' => $token,
        'token_type' => 'Bearer',
    ]);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('guru', APIGuruController::class);
    Route::apiResource('siswa', APISiswaController::class);
    Route::apiResource('industri', APIIndustriController::class);
    Route::apiResource('pkl', APIPklController::class);
});


