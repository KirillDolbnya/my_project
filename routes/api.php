<?php

use App\Http\Controllers\Api\V1\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/v1')->group(function (){
    Route::controller(AuthController::class)->group(function (){
        Route::post('/register','register');
        Route::post('/login','login');
    });

    Route::controller(TaskController::class)->group(function (){
        Route::get('/','getAll');
        Route::get('/{id}','getById');
        Route::post('/create','create');
        Route::patch('/update/{id}','update');
        Route::delete('/delete/{id}','delete');
    })->middleware('auth:sanctum');
});
