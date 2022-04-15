<?php

use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\VkAuthController;
use Illuminate\Support\Facades\Route;

Route::get('/google/login', [GoogleAuthController::class, 'redirect'])->name('google.login');
Route::get('/google/callback', [GoogleAuthController::class, 'callback']);
Route::get('/vk/login', [VkAuthController::class, 'redirect'])->name('vk.login');
Route::get('/vk/callback', [VkAuthController::class, 'callback']);
