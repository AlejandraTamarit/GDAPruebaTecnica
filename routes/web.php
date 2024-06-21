<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/customers', [CustomerController::class, 'store']);

Route::get('/customer', [CustomerController::class, 'show'])->middleware('auth');
Route::delete('/customer', [CustomerController::class, 'destroy'])->middleware('auth');


/*
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth')->group(function () {
    Route::post('/customers', [CustomerController::class, 'store']);
    Route::get('/customers', [CustomerController::class, 'show']);
    Route::delete('/customers/{id}', [CustomerController::class, 'destroy']);
});
*/


//Route::post('/customers', [CustomerController::class, 'store']);
//Route::get('/customers', [CustomerController::class, 'show']);
//Route::delete('/customers/{id}', [CustomerController::class, 'destroy']);