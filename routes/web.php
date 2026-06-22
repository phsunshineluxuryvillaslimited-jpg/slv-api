<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertiesController;
use App\Http\Controllers\PropertiesXmlController;
use App\Livewire\Diaries\Calendar;

Route::view('/', 'welcome');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::view('dashboard', 'dashboard')
        ->middleware(['verified'])
        ->name('dashboard');

    Route::get('/diaries', Calendar::class)->name('diaries');

    Route::view('developers', 'developers.index')
        ->middleware(['verified'])
        ->name('developers');

    Route::view('agents', 'agents.index')
        ->middleware(['verified'])
        ->name('agents');

    Route::view('agent-info', 'agents.agent')
        ->middleware(['verified'])
        ->name('agent-info');

    Route::view('vendors', 'suppliers.index')
        ->middleware(['verified'])
        ->name('vendors');

    Route::view('vendors-info', 'suppliers.vendors')
        ->middleware(['verified'])
        ->name('vendors-info');

    Route::view('profile', 'profile')
        ->name('profile');
    
    Route::resource('properties', PropertiesController::class);

    // Route::view('properties', 'properties.index')->name('properties');

    Route::get('/properties-xml/feed', [PropertiesXmlController::class, 'feed'])->name('property.xml-feed');
});

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

// Route::view('profile', 'profile')
//     ->middleware(['auth'])
//     ->name('profile');

require __DIR__.'/auth.php';
