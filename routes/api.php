<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/slides', function () {
        return session()->pull('slides');
    });

    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
