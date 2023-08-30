<?php

use App\Http\Controllers\Api\CharacterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/create',[CharacterController::class,'create']);
Route::get('/get',[CharacterController::class,'get']);
Route::patch('/edit/{id}',[CharacterController::class,'edit']);
Route::put('/update/{id}',[CharacterController::class,'update']);
Route::delete('/delete/{id}',[CharacterController::class,'delete']);