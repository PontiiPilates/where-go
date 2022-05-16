<?php

namespace App\Listeners;

use App\Events\ActionCreate;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendAppActionCreateNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ActionCreate  $event
     * @return void
     */
    public function handle(ActionCreate $event)
    {
        //
        dd($event);
    }
}
