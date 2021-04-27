<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['namespace'=>'App\Http\Controllers'], function(){
	Route::post("admin-login", 'AuthController@adminLogin');
    Route::middleware(['auth:sanctum', 'guard.admin'])->group(function () {
        Route::get('users', 'UserController@index');
        Route::post('users/save', 'UserController@save');
        Route::get('users/edit/{id}', 'UserController@edit');
        Route::post('users/update/{id}', 'UserController@update');
        Route::get('users/delete/{id}', 'UserController@delete');
        Route::get("admin-logout", 'AuthController@adminLogout');
    });

	Route::post("user-login", 'AuthController@userLogin');
	Route::middleware(['auth:sanctum', 'guard.user'])->group(function () {
		Route::get('users-list', 'UserController@index');
		Route::get('user-edit/{id}', 'UserController@edit');
        Route::post('user-update/{id}', 'UserController@update');
		Route::get("user-logout", 'AuthController@userLogout');
	});

});
