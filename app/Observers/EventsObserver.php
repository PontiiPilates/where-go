<?php

namespace App\Observers;

use App\Models\Event;

// подключение библиотеки кастомных методов
// use App\Models\library\Base;

// подключение класса уведомлений
use App\Notifications\EventNew;
// подключение фассада уведомлений
use Illuminate\Support\Facades\Notification;
// подключение модели пользователя
use App\Models\User;
// подключение модели дополнительных данных пользователя
use App\Models\Profile;

class EventsObserver
{
    /**
     * Handle the Event "created" event.
     *
     * @param  \App\Models\Event  $event
     * @return void
     */
    public function created(Event $event)
    {
        // получение списка идентификаторов подписчиков
        $author = Profile::firstWhere('user_id', $event->user_id);
        $follovers = $author->follovers;
        $follovers = unserialize($follovers);

        // получение моделей подписчиков
        $users = User::whereIn('id', $follovers)->get();

        // отправка уведомлений подписчикам
        Notification::send($users, new EventNew($event));
    }

    /**
     * Handle the Event "updated" event.
     *
     * @param  \App\Models\Event  $event
     * @return void
     */
    public function updated(Event $event)
    {
        //
    }

    /**
     * Handle the Event "deleted" event.
     *
     * @param  \App\Models\Event  $event
     * @return void
     */
    public function deleted(Event $event)
    {
        //
    }

    /**
     * Handle the Event "restored" event.
     *
     * @param  \App\Models\Event  $event
     * @return void
     */
    public function restored(Event $event)
    {
        //
    }

    /**
     * Handle the Event "force deleted" event.
     *
     * @param  \App\Models\Event  $event
     * @return void
     */
    public function forceDeleted(Event $event)
    {
        //
    }
}
