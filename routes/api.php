<?php

use App\Http\Controllers\Api\SlideController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/slides', [SlideController::class, 'index'])->name('api.slides.index');

    Route::get('/user', function (Request $request) {
        return $request->user();
    })->name('api.user');
});
