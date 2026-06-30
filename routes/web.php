<?php

use App\Http\Controllers\AgentController;
use App\Http\Controllers\PropertiesController;
use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\PropertiesXmlController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\S3FileUploadController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Diaries\Calendar;

Route::view('/', 'welcome');

Route::middleware(['auth:sanctum'])->group(function () {
    
    Route::view('dashboard', 'dashboard')
        ->middleware(['verified'])
        ->name('dashboard');

    Route::get('/diaries', Calendar::class)->name('diaries');

    // Route::view('developers', 'developers.index')
    //     ->middleware(['verified'])
    //     ->name('developers');

    // Route::view('agents', 'agents.index')
    //     ->middleware(['verified'])
    //     ->name('agents');

    // Route::view('agent-info', 'agents.agent')
    //     ->middleware(['verified'])
    //     ->name('agent-info');

    // Route::view('vendors', 'suppliers.index')
    //     ->middleware(['verified'])
    //     ->name('vendors');

    // Route::view('clients', 'clients.index')
    //     ->middleware(['verified'])
    //     ->name('clients');

    Route::view('client-info', 'clients.client')
        ->middleware(['verified'])
        ->name('client-info');

    Route::view('vendors-info', 'suppliers.vendors')
        ->middleware(['verified'])
        ->name('vendors-info');

    Route::view('profile', 'profile')
        ->name('profile');
    
    Route::resource('client', ClientController::class);

    Route::resource('bank', BankController::class);

    Route::resource('vendor', VendorController::class);

    Route::resource('agent', AgentController::class);

    Route::resource('developer', DeveloperController::class);

    Route::resource('properties', PropertiesController::class);

    Route::post('properties/{property}/generate-description', [\App\Http\Controllers\PropertyDescriptionController::class, '__invoke'])->name('properties.generate-description');

    // Route::view('properties', 'properties.index')->name('properties');

    Route::get('/properties-xml/feed', [PropertiesXmlController::class, 'feed'])->name('property.xml-feed');

    // upload to S3 Bucket process route
    Route::post('/s3/file-upload', [S3FileUploadController::class, 'upload']);
});

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

// Route::view('profile', 'profile')
//     ->middleware(['auth'])
//     ->name('profile');

require __DIR__.'/auth.php';
