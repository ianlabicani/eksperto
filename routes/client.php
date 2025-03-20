<?php

use App\Http\Controllers\Client\ContractNegotiationController;
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
    Route::put('/contract-negotiations/{id}/accept', [ContractNegotiationController::class, 'accept'])->name('contract-negotiations.accept');
    Route::put('/contract-negotiations/{id}/reject', [ContractNegotiationController::class, 'reject'])->name('contract-negotiations.reject');
    Route::resource('contract-negotiations', ContractNegotiationController::class);
});
