<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobPostController;
use App\Http\Controllers\AlbumController;
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

    Route::get('/albums',[AlbumController::class,'index'])->name('albums.index');
    Route::get('/create-album',[AlbumController::class,'create'])->name('albums.create');
    Route::post('/store',[AlbumController::class,'store'])->name('albums.store');
    Route::get('/edit-album',[AlbumController::class,'edit'])->name('albums.edit');
    Route::delete('/delete-album',[AlbumController::class,'destroy'])->name('albums.destroy');
});

require __DIR__.'/auth.php';
