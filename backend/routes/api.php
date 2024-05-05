<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::middleware(['auth:sanctum'])->group(function (){
    Route::get('auth_user',[UserController::class,'auth_user']);
    Route::get('logout',[AuthController::class,'logout']);
});


// Owner routes
Route::middleware(['auth:api', 'owner'])->group(function () {
    Route::get('/get_users', [UserController::class, 'get_users']);
});

//Route::get('get_users', [UserController::class, 'get_users'])->middleware(['owner']);