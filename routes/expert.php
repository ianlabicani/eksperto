<?php

use App\Http\Controllers\Expert\AddressController;
use App\Http\Controllers\Expert\ContractNegotiationController;
use App\Http\Controllers\Expert\DashboardController;
use App\Http\Controllers\Expert\EducationalBackgroundController;
use App\Http\Controllers\Expert\JobApplicationController;
use App\Http\Controllers\Expert\JobContractController;
use App\Http\Controllers\Expert\JobListingController;
use App\Http\Controllers\Expert\ProfileController;
use Illuminate\Support\Facades\Route;


Route::prefix('expert')->name('expert.')->middleware(['auth', 'profile.complete', 'role:expert'])->group(function () {


    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('address', [AddressController::class, 'update'])->name('address.update');
    Route::patch('address', [AddressController::class, 'update'])->name('address.update');
    Route::get('educational-background', [EducationalBackgroundController::class, 'index'])->name('educational-background.index');
    Route::post('educational-background', [EducationalBackgroundController::class, 'store'])->name('educational-background.store');
    Route::put('educational-background', [EducationalBackgroundController::class, 'update'])->name('educational-background.update');
    Route::patch('educational-background', [EducationalBackgroundController::class, 'update'])->name('educational-background.update');


    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('job-listings', JobListingController::class);
    Route::resource('job-applications', JobApplicationController::class);
    Route::post('job-contracts/accept/{jobContract}', [JobContractController::class, 'accept'])->name('job-contracts.accept');
    Route::post('job-contracts/decline/{jobContract}', [JobContractController::class, 'decline'])->name('job-contracts.decline');
    Route::resource('job-contracts', JobContractController::class);
    Route::resource('contract-negotiations', ContractNegotiationController::class);


});
