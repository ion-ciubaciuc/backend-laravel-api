<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserSettingsController;
use App\Http\Resources\UserResource;
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

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', fn (Request $request) => UserResource::make($request->user()));
    Route::patch('/user/settings', [UserSettingsController::class, 'update']);
});

Route::get('/home', [HomeController::class, 'index']);
