<?php

use App\Http\Controllers\Admin\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;
use App\Http\Controllers\UserController;

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

Route::resource('file', FileController::class);
Route::post('/createProduct', [FileController::class, 'createProduct']);
Route::post('/getProduct', [FileController::class, 'getProduct']);
Route::post('/createOrder', [FileController::class, 'createOrder']);
Route::post('/updateOrder/{id}', [FileController::class, 'updateOrder']);
Route::post('/calculateShippingRate', [FileController::class, 'calculateShippingRate']);

Route::post('/store_template', [ProductsController::class, 'store_template']);
Route::get('/get_template', [ProductsController::class, 'get_template']);
Route::post('/update_template/{id}', [ProductsController::class, 'updateApi']);

Route::post('/storeViaApi', [ProductsController::class, 'storeViaApi']);
