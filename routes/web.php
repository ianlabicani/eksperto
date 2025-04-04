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
