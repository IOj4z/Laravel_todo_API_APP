<?php

use App\Http\Controllers\API\V1\Auth\RegisterController;
use App\Http\Controllers\API\V1\EventController;
use App\Http\Controllers\API\V1\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware([\App\Http\Middleware\LogRequestsMiddleware::class])->group(function () {
    Route::prefix('v1')->group(function () {

        Route::prefix('tasks')->group(function () {
            Route::get('/', [TaskController::class, 'index']);
            Route::post('/', [TaskController::class, 'store'])->middleware('basic.auth');
            Route::get('/{task}', [TaskController::class, 'show'])->middleware('basic.auth');
            Route::put('/{task}', [TaskController::class, 'update'])->middleware('basic.auth');
            Route::delete('/{task}', [TaskController::class, 'destroy'])->middleware('basic.auth');
        });


        Route::prefix('events')->group(function () {
            Route::post('/', [EventController::class, 'create']);
            Route::delete('/{id}', [EventController::class, 'delete']);
        });


        Route::post('/register', [RegisterController::class, 'register']);
    });
});
