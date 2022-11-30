<?php

namespace App\Providers;

use App\Observers\EventsObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

use App\Models\Event;
use App\Services\TelegramService;

class AppServiceProvider extends ServiceProvider

{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Регистрация класса, реализующего функционал Telegram-бота
        $this->app->bind(TelegramService::class, function ($app) {
            return new TelegramService();
        });
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
