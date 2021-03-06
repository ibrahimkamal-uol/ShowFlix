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

Route::get('/', 'WelcomeController@welcome');

Route::resource('testdb', 'TestdbController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::resource('actor','ActorController');

Route::POST('storecomments','CommentController@store');

Route::get('deletecomments','CommentController@delete');

Route::POST('updatecomments','CommentController@update');