<?php

use App\Http\Controllers\DataScamblerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScamblerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/scambles', [ScamblerController::class, 'index'])->name('scambles.index');
    Route::get('/scambles/create', [ScamblerController::class, 'create'])->name('scambles.create');
    Route::post('/scambles', [ScamblerController::class, 'store'])->name('scambles.store');

    Route::get('/scambles-data', [DataScamblerController::class, 'index'])->name('data.scambles.index');
    Route::get('/scambles-data/create', [DataScamblerController::class, 'create'])->name('data.scambles.create');
    Route::post('/scambles-data-post', [DataScamblerController::class, 'store'])->name('data.scambles.store');

     Route::get('/scambles-text', [DataScamblerController::class, 'scambleDataShow'])->name('data.scambles.show');


    
});

require __DIR__.'/auth.php';
