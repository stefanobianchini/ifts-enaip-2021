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
Route::post('/books', 'App\Http\Controllers\BookController@createBook')->middleware('only_localhost');
Route::delete('/books/{id}', 'App\Http\Controllers\BookController@deleteBook')->middleware('only_localhost');
Route::put('/books/{id}', 'App\Http\Controllers\BookController@updateBook')->middleware('only_localhost');
Route::patch('/books/{id}', 'App\Http\Controllers\BookController@partialUpdateBook')->middleware('only_localhost');

Route::get('/authors', 'App\Http\Controllers\AuthorController@getAuthors');
Route::get('/authors/{id}', 'App\Http\Controllers\AuthorController@getSingleAuthor');
Route::middleware('only_localhost')->group(function() {
    Route::post('/authors', 'App\Http\Controllers\AuthorController@createAuthor');
    Route::delete('/authors/{id}', 'App\Http\Controllers\AuthorController@deleteAuthor');
    Route::put('/authors/{id}', 'App\Http\Controllers\AuthorController@updateAuthor');
    Route::patch('/authors/{id}', 'App\Http\Controllers\AuthorController@partialUpdateAuthor');
});
