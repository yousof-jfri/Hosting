<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\Admin\DashbaordController;
use App\Http\Controllers\V1\Admin\ProfileController;
use App\Http\Controllers\V1\Admin\VideoController;
use App\Http\Controllers\V1\FeedBackController;
use App\Http\Controllers\V1\Admin\ManagementController;

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

// THE VERSION 1 REST API
Route::prefix('v1/admin')->middleware('auth:sanctum')->group(function(){
    // get permissions
    Route::post('/user-permissions', [DashbaordController::class, 'userPermissions']);

    // get user watch history
    Route::post('/user-history', [DashbaordController::class, 'userHistory']);

    // Profile
    Route::prefix('profile')->group(function() {
        // edit normal user
        Route::patch('/edit/{user}', [ProfileController::class, 'editProfile']);

        // edit vip users
        Route::patch('edit-vip/{user}', [ProfileController::class, 'editVIPProfile']);

        // edit user phone number
        Route::patch('edit-phone/{user}', [ProfileController::class, 'editPhone']);
        
        // edit user password
        Route::patch('edit-password/{user}', [ProfileController::class, 'editPassword']);
    });

    // Video
        // post a new video
        Route::apiResource('video', VideoController::class);


    // FeedBack
    Route::prefix('feedback')->group(function() {
        // show all feedback
        Route::get('all-feedback', [FeedBackController::class, 'index']);

        // edit feedback status
        Route::patch('edit-status/{feedback}', [FeedBackController::class, 'editStatus']);

        // delete feedback
        Route::delete('delete/{id}', [FeedBackController::class, 'delete']);
    });

    // management
    Route::prefix('manage')->group(function() {
        // manage users
        Route::get('all-users', [ManagementController::class, 'allUsers']);
    });
});