<?php

use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::prefix('profile')->controller(ProfileController::class)->group(function () {
        Route::get('/', 'edit')->name('profile.edit');
        Route::patch('/', 'update')->name('profile.update');
        Route::delete('/', 'destroy')->name('profile.destroy');
    });

    Route::prefix('document')->controller(DocumentController::class)->group(function () {
        Route::post('/', 'store')->name('document.store');
        Route::get('/{document}/download-slider', 'downloadSlider')->name('document.download-slider');
    });

    Route::get('/result', function () {
        return view('result');
    })->name('result');
});

require __DIR__.'/auth.php';
