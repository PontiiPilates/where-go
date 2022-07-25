<?php

namespace App\Providers;

use App\Observers\EventsObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

use App\Models\Event;


class AppServiceProvider extends ServiceProvider

{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Использование пагинации средствами bootstrap
        Paginator::useBootstrap();

        // регистрация обсервера для модели событий
        Event::observe(EventsObserver::class);
    }
}
