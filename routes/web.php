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

        Route::get('author', 'AuthorController@indexPagenate')->name('author.page');

        Route::post('author/store', 'AuthorController@store')->name('author.store');

        Route::post('author/update-ajax', 'AuthorController@updateAjax')->name('author.update.ajax');

        Route::post('author/destroyAjax', 'AuthorController@destroyAjax')->name('author.destroy.ajax');

        Route::resource('book', 'BookController')->only(['show', 'store']);

        Route::get('book/', 'BookController@index')->name('book.page');

        Route::get('list-book-none', 'BookController@listBookNone')->name('list-book-none');

        Route::get('list-book-borrow', 'BookController@listBookBorrow')->name('list-book-borrow');

        Route::get('list-book-view', 'BookController@listBookView')->name('list-book-view');

        Route::post('book/book/destroyAjax', 'BookController@destroyAjax')->name('book.destroy.ajax');

        Route::post('book/update-ajax', 'BookController@updateAjax')->name('book.update.ajax');

        Route::get('book/edit', 'BookController@updateAjax');

        Route::get('/trash-author', 'TrashedController@viewAuthor')->name('trash-author');

        Route::post('/trash-author/restore', 'TrashedController@restoreAuthor')->name('trash-author.restore');

        Route::post('/trash-author/deleteAjax', 'TrashedController@deleteAuthor')->name('trash-author.deleteAjax');

        Route::get('/trash-book', 'TrashedController@viewBook')->name('trash-book');

        Route::post('/trash-book/restore', 'TrashedController@restoreBook')->name('trash-book.restore');

        Route::post('trash-book/deleteAjax', 'TrashedController@deleteBook')->name('trash-book.deleteAjax');

        Route::resource('user', 'UserController');

    });
});

Route::get('/home', 'HomeController@index')->name('home');
