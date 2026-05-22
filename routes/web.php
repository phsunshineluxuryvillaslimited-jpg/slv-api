<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertiesController;
use App\Http\Controllers\PropertiesXmlController;

Route::view('/', 'welcome');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::view('dashboard', 'dashboard')
        ->middleware(['verified'])
        ->name('dashboard');

    Route::view('profile', 'profile')
        ->name('profile');
    
    Route::resource('properties', PropertiesController::class)->names([
        'index' => 'properties',
        'create' => 'web_create',
        'store' => 'web_store',
        'show' => 'web_show',
        'update' => 'web_update',
        'destroy' => 'web_destroy'
    ]);
    Route::get('/properties-xml/feed', [PropertiesXmlController::class, 'feed'])->name('property.xml-feed');
});

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

// Route::view('profile', 'profile')
//     ->middleware(['auth'])
//     ->name('profile');

require __DIR__.'/auth.php';
