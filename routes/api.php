<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(['middleware ' => 'guest:user-api'], function () {
    Route::get('users', [UserController::class, 'getUsers']);
    Route::get('user', [UserController::class, 'user']);
    Route::post('user/store', [UserController::class, 'store']);
    Route::post('user/destroy', [UserController::class, 'destroy']);
    Route::post('user/edit/{id}', [UserController::class, 'update']);
    Route::post('user/login', [UserController::class, 'login']);
});

Route::group(['middleware' => 'auth:user-api'],function(){
    Route::Post('logout',[UserController::class, 'logout']);
    Route::get('categories',[CategoryController::class, 'index']);
    Route::post('categories/store',[CategoryController::class, 'store']);
    Route::post('categories/update',[CategoryController::class, 'update']);
    Route::post('categories/destroy',[CategoryController::class, 'destroy']);
    Route::get('products',[ProductController::class, 'index']);
    Route::post('products/store',[ProductController::class, 'store']);
    Route::post('products/update',[ProductController::class, 'update']);
    Route::post('products/destroy',[ProductController::class, 'destroy']);
});