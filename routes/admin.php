<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:admin']], function() {
    Route::view('/admin', 'admin');
});

Route::controller(LoginController::class)->group(function () {
    Route::get('/login/admin', 'showAdminLoginForm');
    Route::post('/login/admin', 'adminLogin');
});

