<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\ObatController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//this by default using sanctum, but now i using jwt 
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login'])->name('login');

//this using jwt for auth in api
Route::middleware('auth.jwt')->group(function () {
    Route::apiResource('obat', ObatController::class);

    //for logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
