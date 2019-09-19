<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \App\Repositories\Users\UserRepositoryInterface::class,
            \App\Repositories\Users\UserEloquentRepository::class
        );

        $this->app->bind(
            \App\Repositories\Books\BookRepositoryInterface::class,
            \App\Repositories\Books\BookEloquentRepository::class
        );

        $this->app->bind(
            \App\Repositories\Authors\AuthorRepositoryInterface::class,
            \App\Repositories\Authors\AuthorEloquentRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
