<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DataDosenController;
use App\Http\Controllers\DataMahasiswaController;
use App\Http\Controllers\DataMatkulController;
use App\Http\Controllers\FakultasController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\SesiController;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('users', UserController::class);
    Route::apiResource('data-dosen', DataDosenController::class);
    Route::apiResource('data-mahasiswa', DataMahasiswaController::class);
    Route::apiResource('data-matkul', DataMatkulController::class);
    Route::apiResource('fakultas', FakultasController::class);
    Route::apiResource('prodi', ProdiController::class);
    Route::apiResource('sesi', SesiController::class);

});

