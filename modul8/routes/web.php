<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BeliController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('register', [UserController::class, 'register']);
Route::get('users', [UserController::class, 'index']);
Route::get('usersget', [UserController::class, 'show']);

Route::post('products', [ProductController::class, 'store']);
Route::get('productsget', [ProductController::class, 'index']);
Route::get('detailproduk', [ProductController::class, 'searchbyid']);

Route::post('belis', [BeliController::class, 'store']);
Route::get('belisget', [BeliController::class, 'index']);
