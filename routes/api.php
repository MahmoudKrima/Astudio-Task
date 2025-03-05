<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\User\UserController;
use App\Http\Controllers\Api\Project\ProjectAttributeController;
use App\Http\Controllers\Api\Project\ProjectController;
use App\Http\Controllers\Api\TimeSheet\TimeSheetController;

Route::controller(AuthController::class)
    ->group(function () {
        Route::post('/login', 'login');
        Route::post('/register', 'register');
        Route::post('/logout', 'logout')
            ->middleware('auth:api');
    });

Route::controller(UserController::class)
    ->group(function () {
        Route::get('/users', 'index');
        Route::get('/users/{user}', 'show');
        Route::post('/users', 'store');
        Route::put('/users/{user}', 'update');
        Route::delete('/users/{user}', 'delete');
    });

Route::controller(ProjectController::class)
    ->group(function () {
        Route::get('/projects', 'index');
        Route::get('/projects/{project}', 'show');
        Route::post('/projects', 'store')
            ->middleware('auth:api');
        Route::put('/projects/{project}', 'update')
            ->middleware('auth:api');
        Route::delete('/projects/{project}', 'delete')
            ->middleware('auth:api');
    });

Route::controller(ProjectAttributeController::class)
    ->group(function () {
        Route::get('/project-attributes', 'index');
        Route::get('/project-attributes/{attribute}', 'show');
        Route::post('/project-attributes', 'store');
        Route::put('/project-attributes/{attribute}', 'update');
        Route::delete('/project-attributes/{attribute}', 'delete');
    });


Route::controller(TimeSheetController::class)
    ->group(function () {
        Route::get('/time-sheets', 'index');
        Route::get('/time-sheets/{timeSheet}', 'show');
        Route::post('/time-sheets', 'store')
            ->middleware('auth:api');
        Route::put('/time-sheets/{timeSheet}', 'update')
            ->middleware('auth:api');
        Route::delete('/time-sheets/{timeSheet}', 'delete')
            ->middleware('auth:api');
    });
