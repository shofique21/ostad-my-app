<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\VehicleImageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('categories', CategoryController::class);
});

Route::middleware(['auth', 'user'])->group(function () {
    Route::resource('vehicles', VehicleController::class);
    Route::get('favourites', [FavoriteController::class, 'index'])->name('favourites.index');
    Route::post('favourites/{vehicle}', [FavoriteController::class, 'store'])->name('favourites.store');
    Route::delete('favourites/{vehicle}', [FavoriteController::class, 'destroy'])->name('favourites.destroy');
    Route::patch('vehicles/{vehicle}/toggle-active', [VehicleController::class, 'toggleActive'])->name('vehicles.toggle-active');
    Route::get('vehicles/{vehicle}/images', [VehicleImageController::class, 'index'])->name('vehicles.images.index');
    Route::post('vehicles/{vehicle}/images', [VehicleImageController::class, 'store'])->name('vehicles.images.store');
    Route::delete('vehicles/{vehicle}/images/{image}', [VehicleImageController::class, 'destroy'])->name('vehicles.images.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{user}', [MessageController::class, 'show'])->name('messages.show');
    Route::post('/messages/{user}', [MessageController::class, 'store'])->name('messages.store');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
