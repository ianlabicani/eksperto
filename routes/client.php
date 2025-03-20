<?php

use App\Http\Controllers\Client\DashboardController;
use App\Http\Controllers\Client\JobApplicationController;
use App\Http\Controllers\Client\JobContractController;
use App\Http\Controllers\Client\JobListingController;
use Illuminate\Support\Facades\Route;


Route::prefix('client')->name('client.')->middleware(['auth', 'role:client'])->group(function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('job-listings', JobListingController::class);
    Route::resource('job-applications', JobApplicationController::class);
    Route::resource('job-contracts', JobContractController::class);
});
