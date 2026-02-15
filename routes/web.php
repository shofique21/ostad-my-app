<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobPostController;

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

    Route::get('/create-job',[JobPostCOntroller::class, 'create'])->name('job-post');

     Route::get('/all-jobs',[JobPostCOntroller::class, 'index'])->name('job-posts.index');

    Route::post('/job-post',[JobPostCOntroller::class, 'store'])->name('job-posts.store');

    Route::get('/job-edit/{id}',[JobPostCOntroller::class, 'edit'])->name('job-posts.edit');

    Route::get('/job-delete',[JobPostCOntroller::class, 'destroy'])->name('job-posts.destroy');
});

require __DIR__.'/auth.php';
