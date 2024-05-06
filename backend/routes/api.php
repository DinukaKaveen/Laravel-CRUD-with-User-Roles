<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\CustomerController;

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
    Route::post('create_medicine', [MedicineController::class, 'create_medicine']);
    Route::put('update_medicine/{id}', [MedicineController::class,'update_medicine']);
    Route::delete('delete_medicine/{id}', [MedicineController::class,'delete_medicine']);

    Route::post('create_customer', [CustomerController::class, 'create_customer']);
    Route::put('update_customer/{id}', [CustomerController::class,'update_customer']);
    Route::delete('delete_customer/{id}', [CustomerController::class,'delete_customer']);
});

// Manager routes
Route::middleware(['auth:api', 'manager'])->group(function () {
    Route::put('update_customer/{id}', [CustomerController::class,'update_customer']);
    Route::delete('delete_customer/{id}', [CustomerController::class,'delete_customer']);
});

// Cashier routes
Route::middleware(['auth:api', 'cashier'])->group(function () {
    Route::put('update_medicine/{id}', [MedicineController::class,'update_medicine']);
    Route::delete('delete_medicine/{id}', [MedicineController::class,'delete_medicine']);
});

//Route::get('get_users', [UserController::class, 'get_users'])->middleware(['auth:api', 'owner']);