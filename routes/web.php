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
Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'UsersController@home')->name('Users.home');

    Route::get('/users/search', 'UsersController@search')->name('Users.search');

    Route::post('/users/search', 'UsersController@searchUser')->name('Users.searchUser');

    Route::get('/words/create', 'WordsController@create')->name('Words.create');

    Route::post('/words', 'WordsController@store')->name('Words.store');

    Route::get('/words/{id}/edit', 'WordsController@edit')->name('Words.edit');

    Route::put('/words/{id}', 'WordsController@update')->name('Words.update');

    Route::delete('/words/{id}', 'WordsController@destroy')->name('Words.destroy');

    Route::get('/words/test', 'WordsController@test')->name('Words.test');

    Route::get('/words/index', 'WordsController@index')->name('Words.index');

    Route::post('/words/{id}/like', 'WordsController@like')->name('Words.like');
});
