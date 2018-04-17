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

Route::group(['middleware'=>'auth:user-api'], function(){
    Route::get('/user/{id}', 'UserController@getUser');
    Route::post('/user/{id}', 'UserController@updateUser');
    Route::post('/user/{id}/password', 'UserController@updatePassword');
    Route::post('/user/{id}/upload-photo', 'UserController@uploadPhoto');
    Route::get('/menus', 'MenuController@index');
    Route::get('/menu/{id}', 'MenuController@getMenu');
});

Route::group(['middleware'=>'auth:admin-api'], function(){
    Route::get('/users', 'UserController@getUsers');
});

