<?php
Auth::routes();

Route::group(['middleware'=>['auth']], function(){
    Route::resource('borrow', 'BorrowController');

    Route::get('pay', 'PayController@index')->name('pay.index');

    Route::get('information', 'HomeController@information')->name('information');
    Route::get('logout', 'HomeController@logout')->name('logout');
    Route::post('post-information', 'HomeController@updateInformation')->name('post-information');

    Route::put('pay/pay-book', 'PayController@payBook')->name('pay.pay-book');


    Route::group(['middleware'=>['checkPermission']], function(){
        Route::resource('author', 'AuthorController')->except(['create', 'edit']);

        Route::post('author/update/{id}', 'AuthorController@update');

        Route::resource('book', 'BookController');

        Route::post('book/update/{id}', 'BookController@update');

        Route::get('/trash-author', 'TrashedController@viewAuthor')->name('trash-author');

        Route::put('/trash-author/restore', 'TrashedController@restoreAuthor')->name('trash-author.restore');

        Route::delete('/trash-author/delete', 'TrashedController@deleteAuthor')->name('trash-author.delete');

        Route::get('/trash-book', 'TrashedController@viewBook')->name('trash-book');

        Route::put('/trash-book/restore', 'TrashedController@restoreBook')->name('trash-book.restore');

        Route::delete('/trash-book/delete', 'TrashedController@deleteBook')->name('trash-book.delete');

        Route::resource('user', 'UserController');

    });
});

Route::get('/home', 'HomeController@index')->name('home');
