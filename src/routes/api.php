<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FurnitureController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\TagController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:api'])->group(function () {
    Route::apiResource('furniture', FurnitureController::class)->parameters([
        'furniture' => 'id'
    ]);
    Route::apiResource('categories', CategoryController::class)->parameters([
        'category' => 'id'
    ]);
    Route::apiResource('tags', TagController::class)->parameters([
        'tag' => 'id'
    ]);
    Route::post('/logout', [AuthController::class, 'logout']);
});
