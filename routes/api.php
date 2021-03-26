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

// Ricordarsi il prefisso /api/ davanti a tutte le rotte quando le richiamiamo
// da Postman

//Risorsa: book => uri /books

Route::get('/books', 'App\Http\Controllers\BookController@getBooks');
Route::get('/books/{id}', 'App\Http\Controllers\BookController@getSingleBook');
Route::post('/books', 'App\Http\Controllers\BookController@createBook');
Route::delete('/books/{id}', 'App\Http\Controllers\BookController@deleteBook');
Route::put('/books/{id}', 'App\Http\Controllers\BookController@updateBook');
Route::patch('/books/{id}', 'App\Http\Controllers\BookController@partialUpdateBook');

