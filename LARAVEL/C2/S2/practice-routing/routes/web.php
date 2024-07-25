<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function(){
    global $users;
    return  $users;
});
Route::get('/users', function(){
    global $users;
    $user =[];
    foreach($users as $key => $value){
        $user[] = $value['name'];
    }
    return 'The user is '. implode(', ', $user);
});