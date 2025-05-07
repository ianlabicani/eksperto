<?php

use App\Http\Controllers\Client\AddressController;
use App\Http\Controllers\Client\ContractNegotiationController;
use App\Http\Controllers\Client\DashboardController;
use App\Http\Controllers\Client\JobApplicationController;
use App\Http\Controllers\Client\JobContractController;
use App\Http\Controllers\Client\JobListingController;
use App\Http\Controllers\Client\ProfileController;
use Illuminate\Support\Facades\Route;


Route::prefix('client')->name('client.')->middleware(['auth', 'role:client'])->group(function () {

    // ✅ Routes WITHOUT `profile.complete` middleware
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('address', [AddressController::class, 'update'])->name('address.update');

    // ✅ Routes WITH `profile.complete` middleware
    Route::middleware(['profile.complete'])->group(function () {

        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // job listings
        Route::get('job-listings/{jobListing}/job-applications', [JobListingController::class, 'showWithApplications'])->name('job-listings.show-with-applications');
        Route::get('job-listings/{jobListing}/job-contracts', [JobListingController::class, 'showWithContracts'])->name('job-listings.showWithContracts');
        Route::resource('job-listings', JobListingController::class);

        // job applications
        Route::patch('job-applications/{jobApplication}/accept', [JobApplicationController::class, 'accept'])->name('job-applications.accept');
        Route::patch('job-applications/{jobApplication}/reject', [JobApplicationController::class, 'reject'])->name('job-applications.reject');
        Route::resource('job-applications', JobApplicationController::class);

        // job contracts
        Route::resource('job-contracts', JobContractController::class);

        Route::put('/contract-negotiations/{id}/accept', [ContractNegotiationController::class, 'accept'])->name('contract-negotiations.accept');
        Route::put('/contract-negotiations/{id}/reject', [ContractNegotiationController::class, 'reject'])->name('contract-negotiations.reject');
        Route::resource('contract-negotiations', ContractNegotiationController::class);
    });
});

