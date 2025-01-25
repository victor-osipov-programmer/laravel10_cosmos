<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\UserControler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/registration', [UserControler::class, 'store']);
Route::post('/authorization', [AuthController::class, 'authorization']);

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/api/gagarin-flight', [UserControler::class, 'gagarin_flight']);
    Route::get('/flight', [FlightController::class, 'index']);
    Route::get('/lunar-missions', [MissionController::class, 'index']);
    Route::post('/lunar-missions', [MissionController::class, 'store']);
    Route::delete('/lunar-missions/{mission}', [MissionController::class, 'destroy']);
    Route::patch('/lunar-missions/{mission}', [MissionController::class, 'update']);
    Route::post('/lunar-watermark', [ImageController::class, 'lunar_watermark']);
});