<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('admin_template');
})->middleware('auth:sanctum');

Route::get('/event/{event}', function () {
    return view('event.index');
})->middleware('auth:sanctum');

Route::get('/event/my/{event}', function () {
    return view('event.my');
})->middleware('auth:sanctum');

Route::get('/event', function () {
    return view('event.create');
})->middleware('auth:sanctum');

Route::get('/user/{user}', function () {
    return view('user');
})->middleware('auth:sanctum');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
