<?php

use App\Http\Controllers\API\UrlController;
use Illuminate\Support\Facades\Route;

Route::get('/{url}', [UrlController::class, 'redirectTo'])->name('url.redirectTo');
