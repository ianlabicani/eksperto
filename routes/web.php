<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/profile/{profile}', [ProfileController::class, 'show'])->name('profile.show');


require __DIR__ . '/auth.php';
require __DIR__ . '/client.php';
require __DIR__ . '/peso.php';
require __DIR__ . '/expert.php';

// Expert Change Password Routes
Route::get('/expert/change-password', [App\Http\Controllers\Expert\ChangePasswordController::class, 'show'])
  ->name('expert.change-password.show');
Route::put('/expert/change-password', [App\Http\Controllers\Expert\ChangePasswordController::class, 'update'])
  ->name('expert.change-password.update');

// Client Job Contract Status Update Route
Route::patch('/client/job-contracts/{jobContract}/update-status', [App\Http\Controllers\Client\JobContractController::class, 'updateStatus'])
  ->name('client.job-contracts.update-status')
  ->middleware(['auth', 'role:client']);
