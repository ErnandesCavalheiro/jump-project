<?php

use App\Http\Controllers\ServiceOrderController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\EnsureJsonRequest;
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

// Rotas GET service-orders
Route::get('/service-orders', [ServiceOrderController::class, 'index']);
Route::get('/service-orders/{plate}', [ServiceOrderController::class, 'searchByPlate']);

// Rotas GET users
Route::get('/users', [UserController::class, 'index']);

// Rotas POST com o middleware EnsureJsonRequest que faz a requisição aceitar apenas parametros JSON
Route::middleware([EnsureJsonRequest::class])->group(function () {
    Route::post('/service-orders', [ServiceOrderController::class, 'store']);
    Route::post('/users', [UserController::class, 'store']);
});