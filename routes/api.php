<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\UserMiddleware;

Route::get('/user', function (Request $request) {
    return 'Welcome API - Test Middleware';
})->middleware(UserMiddleware::Class);

