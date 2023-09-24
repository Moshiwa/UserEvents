<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('event/{event}', [EventController::class, 'get']);
    Route::get('event/my/{event}', [EventController::class, 'get']);
    Route::get('event/my/{event}/remove', [EventController::class, 'remove']);
    Route::get('event/{event}/participation', [EventController::class, 'participation']);
    Route::get('event/{event}/cancel-participation', [EventController::class, 'cancelParticipation']);
    Route::post('event', [EventController::class, 'create']);
    Route::get('user/{user}', [UserController::class, 'get']);
});
