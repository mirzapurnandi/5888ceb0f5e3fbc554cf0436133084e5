<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api', 'prefix' => 'v1'
], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
});

Route::group([
    'middleware' => ['auth:api'], 'prefix' => 'v1'
], function ($router) {
    Route::get('category', [CategoryController::class, 'index']);
    Route::get('category/{id}', [CategoryController::class, 'view']);
    Route::post('category', [CategoryController::class, 'store']);
    Route::put('category/{id}', [CategoryController::class, 'update']);
    Route::delete('category/{id}', [CategoryController::class, 'destroy']);

    Route::get('product', [ProductController::class, 'index']);
    Route::get('product/{id}', [ProductController::class, 'view']);
    Route::post('product', [ProductController::class, 'store']);
    Route::post('product/image', [ProductController::class, 'store_image']);
    Route::put('product/{id}', [ProductController::class, 'update']);
    Route::delete('product/{id}', [ProductController::class, 'destroy']);

    Route::get('image', [ImageController::class, 'index']);
    Route::get('image/{id}', [ImageController::class, 'view']);
    Route::post('image', [ImageController::class, 'store']);
    Route::post('image/{id}', [ImageController::class, 'update']);
    Route::delete('image/{id}', [ImageController::class, 'destroy']);
});
