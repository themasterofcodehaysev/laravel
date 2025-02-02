<?php

use App\Models\post;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeasonController;

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

Route::get('/posts',[PostController::class,'index']);

Route::post('posts',[PostController::class,'store']);

Route::put('/posts/{post}',[PostController::class,'update']);

Route::delete('/posts/{post}',[PostController::class,'destroy']);

Route::get('/seasons', [SeasonController::class, 'index'])->name('seasons.index');