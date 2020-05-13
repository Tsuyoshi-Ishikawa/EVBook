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
Route::get('/home', 'UsersController@home')->name('home')->middleware('auth'); //showページ

Route::get('/words/create', 'WordsController@create')->middleware('auth');
Route::post('/words', 'WordsController@store')->middleware('auth');
Route::get('/words/{word}/edit', 'WordsController@edit')->middleware('auth');
Route::put('/words/{word}', 'WordsController@update')->middleware('auth');
Route::delete('/words/{id}', 'WordsController@destroy')->middleware('auth');

Route::get('/words/test', 'WordsController@test')->middleware('auth');

Route::get('/words/index', 'WordsController@index')->middleware('auth');
Route::post('/words/{id}/like', 'WordsController@like')->middleware('auth');
