<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertiesController;
use App\Http\Controllers\PropertiesXmlController;

Route::view('/', 'welcome');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::view('dashboard', 'dashboard')
        ->middleware(['verified'])
        ->name('dashboard');

    Route::view('diaries', 'diaries')
        ->middleware(['verified'])
        ->name('diaries');

    Route::view('profile', 'profile')
        ->name('profile');
    
    Route::resource('properties', PropertiesController::class)->names([
        'index' => 'properties.list',
        'create' => 'properties.create',
        'store' => 'properties.store',
        'show' => 'properties.show',
        'update' => 'properties.update',
        'destroy' => 'properties.destroy'
    ]);

    Route::view('properties', 'properties.index')->name('properties');

    Route::get('/properties-xml/feed', [PropertiesXmlController::class, 'feed'])->name('property.xml-feed');
});

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

// Route::view('profile', 'profile')
//     ->middleware(['auth'])
//     ->name('profile');

require __DIR__.'/auth.php';
