<?php

use App\Http\Controllers\V1\AuthController;
use App\Http\Controllers\V1\CinemaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\FeedBackController;

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


// the v1 api
Route::prefix('v1')->group(function(){

    // protected by sanctum 
    Route::middleware('auth:sanctum')->group(function () {
        
    });

    // auth
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register-vip', [AuthController::class, 'registerVIP']);

    // feed backs
    Route::prefix('feedback')->group(function() {
        Route::post('store-feedback', [FeedBackController::class, 'store']);
    });

    // Cinema Routes
    Route::prefix('cinema')->group(function () {
        // show all the video
        Route::get('videos', [CinemaController::class, 'index']);

        // show current video
        Route::get('video/{video}/{id}', [CinemaController::class, 'show']);
    });
});

