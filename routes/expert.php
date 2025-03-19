<?php

use App\Http\Controllers\Expert\DashboardController;
use App\Http\Controllers\Expert\JobApplicationController;
use App\Http\Controllers\Expert\JobListingController;
use Illuminate\Support\Facades\Route;


Route::prefix('expert')->name('expert.')->middleware(['auth', 'role:expert'])->group(function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('job-listings', JobListingController::class);
    Route::resource('job-applications', JobApplicationController::class);
});
