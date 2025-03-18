<?php

use App\Http\Controllers\Client\DashboardController;
use App\Http\Controllers\Client\JobListingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::prefix('client')->name('client.')->middleware(['auth', 'role:client'])->group(function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('job-listings', JobListingController::class);
});
