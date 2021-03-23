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

// /api/users

Route::get('/users', 
'App\Http\Controllers\DemoController@getUsers');
Route::get('/users/{id}', 
'App\Http\Controllers\DemoController@getSingleUser'); 
Route::post('/users', 
'App\Http\Controllers\DemoController@postUsers');
Route::put('/users/{id}', 
'App\Http\Controllers\DemoController@putUsers');
Route::patch('/users/{id}', 
'App\Http\Controllers\DemoController@patchUsers');
Route::delete('/users/{id}', 
'App\Http\Controllers\DemoController@deleteUsers');