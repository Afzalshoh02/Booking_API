<?php
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ResourceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('resources', ResourceController::class)->only(['store', 'index']);
Route::post('bookings', [BookingController::class, 'store']);
Route::get('resources/{id}/bookings', [BookingController::class, 'index']);
Route::delete('bookings/{id}', [BookingController::class, 'destroy']);
