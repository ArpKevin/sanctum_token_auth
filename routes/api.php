<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CsokiController;
use App\Http\Controllers\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('csokik', CsokiController::class);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::post('/add-csoki', [AuthController::class, 'addCsoki'])->middleware('auth:sanctum');

Route::get('/user-csoki-ids', [AuthController::class, 'getUserCsokiIds'])->middleware('auth:sanctum');