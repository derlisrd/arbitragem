<?php

use App\Http\Controllers\TestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
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

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */


Route::prefix("auth")->group(function(){

    Route::post("login",[UsersController::class,"login"]);

    Route::post("register",[UsersController::class,"register"]);

    Route::post("refreshtoken",[UsersController::class,"refreshtoken"]);

    Route::post("validatetoken",[UsersController::class,"validatetoken"]);

    Route::post("logout",[UsersController::class,"logout"]);
});

Route::get("/google",[TestController::class,"google"]);
Route::get("/facebook",[TestController::class,"facebook"]);

Route::get("/facebookcallback",[TestController::class,"facebookcallback"]);

Route::get("/politicas",[TestController::class,"politicas"]);



