<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Auth\AuthController;


Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);
Route::post('signup', [AuthController::class, 'signup']);


Route::middleware('auth:sanctum')->group(function () {

    Route::get('user', [AuthController::class, 'user']);
});