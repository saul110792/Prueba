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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users', 'App\Http\Controllers\UsersController@getUsers');

Route::get('/getUsersId/{id}', 'App\Http\Controllers\UsersController@getUsersId');

Route::get('/getPhoneUsersId/{id}', 'App\Http\Controllers\UsersController@getPhoneUsersId');

Route::post('/addUser','App\Http\Controllers\UsersController@addUser');

Route::put('/editUser/{id}','App\Http\Controllers\UsersController@editUser');

Route::delete('/deleteUser/{id}','App\Http\Controllers\UsersController@deleteUser');