<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ContactController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| These routes return JSON responses for mobile apps.
| They are separate from your web routes (Blade views).
|--------------------------------------------------------------------------
*/

// 🔹 Authentication
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);

// 🔹 Public products (JSON only, for mobile)
Route::get('/products',      [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);

// 🔐 Protected routes (require Sanctum token)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me',     [AuthController::class, 'me']);
    Route::post('/logout',[AuthController::class, 'logout']);

    // Orders
    Route::get('/orders',       [OrderController::class, 'index']);
    Route::get('/orders/{id}',  [OrderController::class, 'show']);
    Route::post('/orders',      [OrderController::class, 'store']);

    // Contact
    Route::post('/contact',     [ContactController::class, 'store']);
});
