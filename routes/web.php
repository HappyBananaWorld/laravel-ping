<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\TestingController::class,'index']);
Route::get('/ping',[\App\Http\Controllers\ShowMessageController::class,'index']);
