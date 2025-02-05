<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobListingController;

Route::get('/', fn() => view('welcome'));
Route::get('/dashboard', fn() => view('dashboard'))->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route::post('/delete-resume', [RegisteredUserController::class, 'deleteResume'])->name('delete.resume');

});

Route::get('/job_listings', [JobListingController::class, 'index'])->name('job_listings.index')->middleware(['auth']);
//
//
Route::middleware(['auth', 'can:create job'])->group(function () {

    Route::get('job_listings/create', [JobListingController::class, "create"])->name('job_listings.create');

    Route::get('/job_listings/{job_listing:id}/edit', [JobListingController::class, 'edit'])->name('job_listings.edit');

    Route::delete('/job_listings/{job_listing:id}/destroy', [JobListingController::class, 'destroy'])->name('job_listings.destroy');

    Route::patch('/job_listings/{job_listing:id}/update', [JobListingController::class, 'update'])->name('job_listings.update');

    Route::post('/job_listings/store', [JobListingController::class, 'store'])->name('job_listings.store');
    // Application routes
    Route::patch("job_listings/application/{application:id}/reject", [ApplicationController::class, 'reject'])->name("application.reject");
    Route::patch("job_listings/application/{application:id}/approve", [ApplicationController::class, 'approve'])->name("application.approve");
    Route::get("job_listings/applications", [ApplicationController::class, 'index'])->name('application.index');
});

// Application routes
Route::middleware(['auth', 'can:apply job'])->group(function () {

    Route::get('/job_listings/{job_listing:id}/apply', [ApplicationController::class, 'create'])->name('application.create');
    Route::post('/jobs_listings/{job_listing:id}/apply/store', [ApplicationController::class, 'store'])->name('application.store');
});
Route::get('/job_listings/{job_listing:id}', [JobListingController::class, 'show'])->name('job_listings.show')->middleware('auth');



Route::get('/users', [UserController::class, 'index'])->name('users.index');

Route::post('/job_listings/{job_listing:id}/approve', [JobListingController::class, 'approve'])->middleware('auth', 'admin');





// Route::get('/job_listings/create', [JobListingController::class, 'create'])->name('job_listings.create');




// Route::middleware(['auth', 'can:apply job'])->group(function () {
//     Route::get('/jobs', function () {
//         return view('jobs.index');
//     })->name('jobs.index');
// Route::get('/jobs/apply/{job}', function ($job) {
//         return "Apply for job ID: " . $job;
//     })->name('jobs.apply');
// });




require __DIR__ . '/auth.php';
