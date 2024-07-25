<?php

use App\Http\Controllers\PostController;
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

Route::resource('/posts',PostController::class);



// Protected routes
// Route::middleware('auth:sanctum')->group(function () {
//     Route::get('/users',[UserController::class,'index']);
//     Route::post('/register', [UserController::class, 'createUser']);
//     Route::post('/login', [UserController::class, 'loginUser']);
//     Route::post('/logout', [UserController::class, 'logout']);
// });

Route::get('/users',[UserController::class,'index']);
Route::post('/register', [UserController::class, 'createUser']);
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/logout', [UserController::class, 'logout']);