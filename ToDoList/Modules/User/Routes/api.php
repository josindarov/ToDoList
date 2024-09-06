<?php

use Illuminate\Support\Facades\Route;
use Modules\User\app\Controller\Auth\LoginController;
use Modules\User\app\Controller\Auth\LogoutController;
use Modules\User\app\Controller\Auth\RegisterController;

Route::post('/register', RegisterController::class)->name('auth.register');
Route::post('/login', LoginController::class)->name('auth.login');
Route::post('/logout', LogoutController::class)->middleware('auth:sanctum')->name('auth.logout');
