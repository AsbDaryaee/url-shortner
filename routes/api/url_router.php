<?php

use App\Http\Controllers\API\UrlController;
use Illuminate\Support\Facades\Route;

Route::prefix('/')->group(function () {
    Route::apiResource('url', UrlController::class)->except(['show'])->middleware('auth:sanctum');
    Route::get('url/{url}', [UrlController::class, 'show'])->name('url.show');
});
