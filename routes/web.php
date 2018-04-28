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

Route::get('/test', function(){
    return view('test');
});

Route::prefix('user')->group(function (){
    Route::post('/signup', 'UserAndroidController@signUp');
    Route::post('/reset-password', 'UserAndroidController@resetPassword');
    Route::get('/login', 'Auth\UserLoginController@showLoginForm')->name('user.login');
    Route::post('/login', 'Auth\UserLoginController@userLogin')->name('user.login.submit');
    Route::post('/logout', 'Auth\UserLoginController@userLogout')->name('user.logout');
});

Route::prefix('admin')->group(function(){
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::post('/logout', 'Auth\AdminLoginController@adminLogout')->name('admin.logout');
    Route::resource('user', 'UserController');
    Route::put('/user/{id}/password', 'UserController@UpdatePassword')->name('user.update_password');
    Route::get('/', 'DashboardController@index')->name('admin.dashboard');

});