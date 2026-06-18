<?php

use App\Http\Controllers\Api\v1\PropertiesController as V1PropertiesController;
use App\Http\Controllers\Api\v1\PropertyTypesController as V1PropertyTypesController;
use App\Http\Controllers\Api\v1\UsersController as V1UsersController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('v1')
        ->name('api.')
        ->group(function () {
            Route::apiResource('properties', V1PropertiesController::class);
            Route::get('properties/reference/{reference}', [V1PropertiesController::class, 'showByReference']);

            Route::apiResource('users', V1UsersController::class);
            Route::apiResource('property-types', V1PropertyTypesController::class);
        });
});

// Route::middleware('api')->group(function () {
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class, 'destroy']);
Route::post('/register', [RegisteredUserController::class, 'store']);
// });

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// require __DIR__.'/auth.php';
