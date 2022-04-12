<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;

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

/*** AUTH ROUTE ***/
Route::any('auth/create', [RegisterController::class, 'createUser']);

Route::any('auth/login', [RegisterController::class, 'loginUser']);
Route::any('auth/logout', [RegisterController::class, 'logoutUser']);
Route::any('auth/error404', [RegisterController::class, 'error404']);
