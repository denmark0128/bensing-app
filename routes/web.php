<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use App\Services\UserService;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-container', function (Request $request){
    $input = $request->input('key');
    return $input;
});

Route::get('/test-provider', function (UserService $userService){
    return $userService->listUsers();
});
