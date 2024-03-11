<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VacationController;

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

//Auth
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//Vacation
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/vacation', [VacationController::class, 'index']);
    Route::get('/vacation/{id}', [VacationController::class, 'show']);
    Route::post('/vacation', [VacationController::class, 'store']);
    Route::put('/vacation/{id}', [VacationController::class, 'update']);
    Route::delete('/vacation/{id}', [VacationController::class, 'destroy']);
    Route::get('/vacation/{id}/pdf', [VacationController::class, 'generatePdf']);
});

