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

Route::get('/home', ['uses' => 'AppController@home', 'as' => 'home'])->middleware('auth');

Route::post('/api/upload/image', ['uses' => 'ApiController@uploadImage', 'as' => 'api.upload.image']);

Route::get('/', ['uses' => 'AppController@index', 'as' => 'index']);

// Page
Route::get('/{link}', ['uses' => 'PageController@item', 'as' => 'page.item']);

// Comment
Route::post('/comment/submit', ['uses' => 'CommentController@store', 'as' => 'comment.submit']);
