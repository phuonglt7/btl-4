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
    return view('authors.index');
});

Auth::routes();

Route::resource('author', 'AuthorController');
Route::post('author/update/{id}', 'AuthorController@update');
Route::resource('book', 'BookController');
Route::post('book/update/{id}', 'BookController@update');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/trash-author', 'TrashedController@viewAuthor')->name('trash-author');
