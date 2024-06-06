<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
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


Route::prefix('admin')->middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::apiResource('books', BookController::class);
    Route::get('/books/type/{type}', [BookController::class, 'sortedBooksByType']);

    Route::get('orders', [OrderController::class, 'index']);
    Route::get('show_order/{order}', [OrderController::class, 'show']);
    Route::put('update_order/{order}', [OrderController::class, 'update']);

    Route::put('update_admin/{admin}', [UserController::class, 'updateAdmin']);
    Route::get('dashboard', [Controller::class, 'dashboard']);
});


Route::prefix('client')->middleware(['auth:sanctum', 'role:client'])->group(function () {
    Route::get('books', [BookController::class, 'index']);
    Route::get('show_book/{book}', [BookController::class, 'show']);
    Route::get('/books/type/{type}', [BookController::class, 'sortedBooksByType']);

    Route::get('orders', [OrderController::class, 'ClientOrders']);
    Route::post('create_order', [OrderController::class, 'store']);

    Route::put('update_client/{client}', [UserController::class, 'updateClient']);
});


Route::post('/auth/registerAdmin', [AuthController::class, 'createAdmin']);
Route::post('/auth/registerClient', [AuthController::class, 'createUser']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);
