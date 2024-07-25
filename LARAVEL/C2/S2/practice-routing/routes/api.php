<?php

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


Route::prefix('/user')->group(function(){
    Route::get('/', function(){
        global $users;
        return  $users;
    });
    Route::get('/{userIndex}', function ($userIndex) {
        global $users;
        if (isset($users[$userIndex])) {
            return $users[$userIndex];
        } else {
            return 'Cannot found user with index '. $userIndex;
        }
    })->where('userid','[0-9]+');
    Route::get('/name/{userName}',function($userName){
        global $users;
        foreach($users as $key => $value){
            if($userName ==  $value['name']){
                return $value;
            }
            
        }
    });
    Route::get('/{userIndex}/post/{postIndex}',function($index,$post){
        global $users;
        if(isset($users[$index]['posts'][$post])){
            return $users[$index]['posts'][$post];
        }else{
            return 'Cannot found post with index '. $post;
        };
    });
    
});
