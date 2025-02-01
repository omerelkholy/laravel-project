<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobListingController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('welcome'));
Route::get('/dashboard', fn() => view('dashboard'))->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('job_listings', JobListingController::class);    
    Route::post('/job_listings/{jobListing}/approve', [JobListingController::class, 'approve'])->middleware('auth', 'admin');
});

require __DIR__.'/auth.php';