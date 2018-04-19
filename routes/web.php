<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', function(){
    return view('welcome');
});

Route::prefix('user')->group(function (){
    Route::get('/login', 'Auth\UserLoginController@showLoginForm')->name('user.login');
    Route::post('/login', 'Auth\UserLoginController@userLogin')->name('user.login.submit');
    Route::post('/logout', 'Auth\UserLoginController@userLogout')->name('user.logout');
    Route::post('/{id}/upload', 'UserController@uploadPhoto')->name('user.upload');
    Route::get('/', 'UserController@index')->name('dashboard');
});

Route::prefix('admin')->group(function(){
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::post('/logout', 'Auth\AdminLoginController@adminLogout')->name('admin.logout');
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
});