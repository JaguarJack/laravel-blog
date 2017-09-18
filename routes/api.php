<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Api')->group(function(){
    Route::post('/userPage','User@page')->middleware('checkapirequest');
    Route::post('/getlinks','Links@getLinks')->middleware('checkapirequest');
    Route::post('/getUsers','Users@getUsers')->middleware('checkapirequest');
    Route::post('/userForbidden','Users@forbidden')->middleware('checkapirequest');
    Route::post('/getArticles','Article@getArticles')->middleware('checkapirequest');
    Route::post('/like','Operation@like');
    Route::post('/store','Operation@store');
    Route::post('/attend','Operation@attend');
});
