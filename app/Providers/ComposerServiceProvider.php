<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        view()->composer(
            ['authors.index', 'books.index', 'books.show', 'trashed.indexAuthor', 'trashed.indexBook', 'users.index', 'borrow.index'],
            'App\Http\ViewComposers\STTComposer'
        );

        view()->composer(
            ['books.index', 'books.show', 'books.add', 'authors.index'],
            'App\Http\ViewComposers\AuthorComposer'
        );
    }
}
