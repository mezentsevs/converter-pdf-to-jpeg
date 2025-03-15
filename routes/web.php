<?php

use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });

    Route::controller(DocumentController::class)->group(function () {
        Route::post('/document', 'store')->name('document.store');
        Route::get('/document/{document}/download-slider', 'downloadSlider')->name('document.download-slider');
    });

    Route::get('/result', function () {
        return view('result');
    })->name('result');
});

require __DIR__.'/auth.php';
