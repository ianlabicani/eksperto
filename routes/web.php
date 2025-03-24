<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/contact', [ContactController::class, 'update'])->name('contact.update');
    Route::patch('/address', [AddressController::class, 'update'])->name('address.update');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/client.php';
require __DIR__ . '/peso.php';
require __DIR__ . '/expert.php';
