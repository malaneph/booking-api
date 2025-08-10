<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(UserController::class)->group(function () {
    Route::get('/user', 'index');
    Route::post('/login', 'login');
})->middleware('auth:sanctum');

Route::prefix('/bookings')->controller(BookingController::class)->group(function () {
    Route::post('/', 'create');
    Route::prefix('/{booking}')->group(function () {
        Route::delete('/', 'delete');
    });
})->middleware('auth:sanctum');

Route::prefix('/rooms')->controller(RoomController::class)->group(function () {
    Route::prefix('{room}')->group(function () {
        Route::get('/slots', 'slots');
    });
});
