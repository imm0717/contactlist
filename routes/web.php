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
    return redirect('/home');
});

Auth::routes();

Route::get('/home', 'ContactController@index')->name('home');
Route::get('/contacts', 'ContactController@getAll')->name('contacts');
Route::post('/contacts', 'ContactController@add')->name('Add contact');
Route::put('/contacts/{id}', 'ContactController@update')->name('Update contact');
Route::delete('/contacts/{id}', 'ContactController@delete')->name('Delete contact');
