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

    Route::post('users/login','UsersController@login');
    Route::post('users/registered','UsersController@registered');

Route::group(['middleware'=>'refresh.token'],function(){
    //测试是否携带token
    Route::post('users/test','UsersController@test');
});

