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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'UsersController@home')->name('home'); //showページ

Route::get('/words/create', 'WordsController@create');
Route::post('/words', 'WordsController@store');
Route::get('/words/{word}/edit', 'WordsController@edit');
Route::put('/words/{word}', 'WordsController@update');
Route::delete('/words/{id}', 'WordsController@destroy');

Route::get('/words/test', 'WordsController@test');

Route::get('/words/index', 'WordsController@index');
Route::post('/words/{id}/like', 'WordsController@like');
