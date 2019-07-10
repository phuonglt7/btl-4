<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(
            ['authors.index', 'books.index', 'books.show'],
            'App\Http\ViewComposers\STTComposer'
        );

        view()->composer(
            ['books.index'],
            'App\Http\ViewComposers\StatusBookComposer'
        );

        view()->composer(
            ['books.index', 'books.show', 'books.add'],
            'App\Http\ViewComposers\AuthorComposer'
        );
    }
}
