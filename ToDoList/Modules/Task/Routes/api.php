<?php

namespace Modules\Task\Routes;

use Illuminate\Support\Facades\Route;
use Modules\Task\app\Controllers\Task\DestroyController;
use Modules\Task\app\Controllers\Task\ExportTaskController;
use Modules\Task\app\Controllers\Task\ImportTaskController;
use Modules\Task\app\Controllers\Task\IndexController;
use Modules\Task\app\Controllers\Task\ShowController;
use Modules\Task\app\Controllers\Task\StoreController;
use Modules\Task\app\Controllers\Task\UpdateController;

Route::middleware('auth:sanctum')->group(function (){
    Route::get('/index', IndexController::class)->name('task.index');
    Route::get('/show/{task}', ShowController::class)->name('task.show');
    Route::post('/store', StoreController::class)->name('task.store');
    Route::put('/update/{task}', UpdateController::class)->name('task.update');
    Route::delete('/delete/{task}', DestroyController::class)->name('task.destroy');
    Route::post('/tasks/upload', ImportTaskController::class)->name('tasks.upload');
    Route::get('tasks/download', ExportTaskController::class)->name('tasks.download');
});
