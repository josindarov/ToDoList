<?php

use App\Http\Controllers\Categories\IndexController;
use App\Http\Controllers\Categories\StoreController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->group(function (){
    Route::post('/category/store', StoreController::class)->name('category.store');
    Route::get('/category/index', IndexController::class)->name('category.index');
});

