<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware('auth')->group(function () {
    Route::resource('profile', ProfileController::class)->only(['edit', 'show', 'update', 'destroy']);
    Route::patch('/contact', [ContactController::class, 'update'])->name('contact.update');
    Route::patch('/address', [AddressController::class, 'update'])->name('address.update');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/client.php';
require __DIR__ . '/peso.php';
require __DIR__ . '/expert.php';
