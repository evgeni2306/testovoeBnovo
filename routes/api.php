<?php

use App\Http\Controllers\VisitorController;
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

Route::post('/visitor/create', [VisitorController::class, 'create']);
Route::post('/visitor/update', [VisitorController::class, 'update']);
Route::post('/visitor/get', [VisitorController::class, 'get']);
Route::post('/visitor/delete', [VisitorController::class, 'delete']);
