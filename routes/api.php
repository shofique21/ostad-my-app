<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ScambleController;

Route::get('/scamble-text', [ScambleController::class, 'allScamble'])->name('api.scamble-text');;
Route::post('/scambles-text-post', [ScambleController::class, 'store']);