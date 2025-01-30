<?php
use App\Http\Controllers\homeController;
use App\Http\Controllers\iotController;
use App\Http\Controllers\camController;
use Illuminate\Support\Facades\Route;

Route::get('/', [homeController::class, 'index']);
Route::get('/iot', [iotController::class, 'index']);
Route::get('/cam', [camController::class, 'index']);
