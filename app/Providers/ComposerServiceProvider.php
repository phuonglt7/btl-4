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
            ['authors.index'],
            'App\Http\ViewComposers\STTComposer'
        );

        view()->composer(
            ['books.index'],
            'App\Http\ViewComposers\StatusBookComposer'
        );
    }
}
