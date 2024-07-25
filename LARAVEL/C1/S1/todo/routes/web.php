<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Return view file
Route::get("/homepage", function (){
    return view("home");
})->name('home'); 
// ->name('home');
//Just change the name of route to make it shorter

Route::get('/about', function(){
    return view("about");
});

//Return text and ka jab yk parameter
Route::get("/teacher/{name}/age/{age?}", function($name,$age = null){
    return "your teacher is ".$name." He is ".$age." year old";
});

Route::fallback(function(){
    return 'Page not fund, 404!';
});

//Prefix route

Route::prefix('product')->group(function(){
    Route::get('/', function(){
        return 'Product Page';
    });
    Route::get('create', function(){
        return 'Create a product Page';
    });
    Route::put('/edit', function(){
        return 'Edit Product Page';
    });
    Route::delete('/delete', function(){
        return 'Delete Product Page';
    });
});

//Route parameters
Route::get('/student/name/{studentName}',function($studentName){
    return 'student name is '.$studentName;
})->where('studentName','[A-Za-z]');

Route::get('/student/id/{studentid}',function($studentid){
    return 'student id is '.$studentid;
})->where('studentid','[0-9]+');