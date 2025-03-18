<?php

use App\Http\Controllers\Peso\DashboardController;
use App\Http\Controllers\Peso\JobListingController;
use Illuminate\Support\Facades\Route;


Route::prefix('peso')->name('peso.')->middleware(['auth', 'role:peso'])->group(function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('job-listings', JobListingController::class);

});
