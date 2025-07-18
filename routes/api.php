<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SupplyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/supplies-search', [SupplyController::class, 'index']);
    Route::get('/supplies/{id}', [SupplyController::class, 'find']);
    Route::post('/supplies', [SupplyController::class, 'store']);
    Route::put('/supplies/{id}', [SupplyController::class, 'update']);
    Route::delete('/supplies/{id}', [SupplyController::class, 'destroy']);
});

Route::post('/login', [AuthController::class, 'login']);
