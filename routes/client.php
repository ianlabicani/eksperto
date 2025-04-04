<?php

use App\Http\Controllers\Client\ContractNegotiationController;
use App\Http\Controllers\Client\DashboardController;
use App\Http\Controllers\Client\JobApplicationController;
use App\Http\Controllers\Client\JobContractController;
use App\Http\Controllers\Client\JobListingController;
use App\Http\Controllers\Client\ProfileController;
use Illuminate\Support\Facades\Route;


Route::prefix('client')->name('client.')->middleware(['auth', 'profile.complete', 'role:client'])->group(function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');


    Route::get('job-listings/{jobListing}/job-applications', [JobListingController::class, 'showWithApplications'])->name('job-listings.showWithApplications');
    Route::resource('job-listings', JobListingController::class);
    Route::resource('job-applications', JobApplicationController::class);
    Route::resource('job-contracts', JobContractController::class);
    Route::put('/contract-negotiations/{id}/accept', [ContractNegotiationController::class, 'accept'])->name('contract-negotiations.accept');
    Route::put('/contract-negotiations/{id}/reject', [ContractNegotiationController::class, 'reject'])->name('contract-negotiations.reject');
    Route::resource('contract-negotiations', ContractNegotiationController::class);
});
