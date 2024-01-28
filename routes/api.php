<?php

use App\Http\Controllers\API\V1\Auth\RegisterController;
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
        Route::post('/register', [RegisterController::class, 'register']);

        Route::get('/tasks', [TaskController::class, 'index']);
        Route::post('/tasks', [TaskController::class, 'store'])->middleware('basic.auth');
        Route::get('/tasks/{task}', [TaskController::class, 'show'])->middleware('basic.auth');
        Route::put('/tasks/{task}', [TaskController::class, 'update'])->middleware('basic.auth');
        Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->middleware('basic.auth');
    });
});
