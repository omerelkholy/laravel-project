<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Middleware\PermissionMiddleware;
use App\Http\Controllers\JobController;
use App\Http\Controllers\Auth\RegisteredUserController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'can:manage users'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

Route::middleware(['auth', 'can:create job'])->group(function () {
    Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
    Route::post('/jobs/store', [JobController::class, 'store'])->name('jobs.store');
    Route::post('/jobs/manage', [JobController::class, 'manage'])->name('jobs.manage');
});

Route::middleware(['auth', 'can:apply job'])->group(function () {
    Route::get('/jobs', function () {
        return view('jobs.index');
    })->name('jobs.index');

    Route::get('/jobs/apply/{job}', function ($job) {
        return "Apply for job ID: " . $job;
    })->name('jobs.apply');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');  
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');    
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');    

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/delete-resume', [RegisteredUserController::class, 'deleteResume'])->name('delete.resume');
});




require __DIR__.'/auth.php';
