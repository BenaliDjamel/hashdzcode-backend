<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
 */
Route::post('/login', function(Request $request) {
    $request->validate([
        "email" => "required",
        "password"=>"required",
    ]);

    auth()->attempt($request->only('email', 'password'));
    return auth()->user();


});
Route::post('/logout', function(Request $request) {
  
    return auth()->logout();

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});