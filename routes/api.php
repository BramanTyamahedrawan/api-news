<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::post('/users/login', [UserController::class, 'login']);

Route::group(['middleware' => ['auth:api', 'role:admin']], function () {
    Route::get('/users/current', [UserController::class, 'getUserCurrent']);
});
