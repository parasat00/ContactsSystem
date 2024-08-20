<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('user', [UserController::class, 'show']);
    Route::post('user/update', [UserController::class, 'update']);
    Route::prefix('contacts')->group(function () {
        Route::get('', [ContactController::class, 'index']);
        Route::post('', [ContactController::class, 'store']);
        Route::middleware('ownsContact')->group(function () {
            Route::get('{contact}', [ContactController::class, 'show']);
            Route::put('{contact}', [ContactController::class, 'update']);
            Route::delete('{contact}', [ContactController::class, 'destroy']);
        });
    });


});
