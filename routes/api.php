<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\VenueController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function(){
    Route::get('/user', function (Request $request) { return $request->user(); });
    Route::get('/authenticated', function () { return true; });

    Route::prefix('venue')->group(function(){
        Route::get('/', [VenueController::class, 'index']);
        Route::post('/', [VenueController::class, 'store'])->middleware('isAdmin');
        Route::delete('/{id}', [VenueController::class, 'destroy'])->middleware('isAdmin');
    });
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);