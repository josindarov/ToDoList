<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Task\DestroyController;
use App\Http\Controllers\Task\IndexController;
use App\Http\Controllers\Task\ShowController;
use App\Http\Controllers\Task\StoreController;
use App\Http\Controllers\Task\UpdateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API router
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// router for Authentication
Route::post('/register', RegisterController::class)->name('auth.register');
Route::post('/login', LoginController::class)->name('auth.login');
Route::post('/logout', LogoutController::class)->middleware('auth:sanctum')->name('auth.logout');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Task Controller router
Route::middleware('auth:sanctum')->prefix('task')->name('task.')->group(function (){
    Route::get('/index', IndexController::class)->name('index');
    Route::get('/show/{task}', ShowController::class)->name('show');
    Route::post('/store', StoreController::class)->name('store');
    Route::put('/update/{task}', UpdateController::class)->name('update');
    Route::delete('/delete/{task}', DestroyController::class)->name('destroy');
});


