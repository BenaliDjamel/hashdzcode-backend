<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ArticleController;


Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('logout', [AuthController::class, 'logout']);
Route::post('signup', [AuthController::class, 'signup']);

Route::get('login/github', [AuthController::class, 'redirectToProvider']);
Route::get('login/github/callback', [AuthController::class, 'handleProviderCallback']);


Route::middleware('auth:sanctum')->group(function () {

    Route::get('users/{user}/articles', [ArticleController::class, 'articlesForUser']);
    Route::get('articles', [ArticleController::class, 'index']);
    Route::get('articles/{slug}', [ArticleController::class, 'show']);
    Route::post('articles', [ArticleController::class, 'store']);
    Route::patch('articles/{article}', [ArticleController::class, 'update']);
    Route::delete('articles/{article}', [ArticleController::class, 'delete']);
    Route::get('articles/{article}/user', [ArticleController::class, 'authorOfArticle']);
});


