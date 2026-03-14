<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItineraryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FavoriteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, "register"]);
Route::post('/login', [AuthController::class, "login"]);

Route::middleware("auth:sanctum")->group(function () {
    Route::get("/user", [UserController::class, "show"]);
    
    Route::apiResource("/itinerary", ItineraryController::class);
    Route::prefix("/favorites")->group(function () {
        Route::get("/", [FavoriteController::class, "index"]);
        Route::post("/{id}", [FavoriteController::class, "store"]);
        Route::delete("/{id}", [FavoriteController::class, "destroy"]);
    });
});

Route::fallback(function (){
    return response()->json([
        "404" => "route does not exists"
    ]);
});