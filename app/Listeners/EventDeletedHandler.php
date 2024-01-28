<?php

namespace App\Listeners;

use App\Events\EventDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class EventDeletedHandler
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
     * @param  \App\Events\EventDeleted  $event
     * @return void
     */
    public function handle(EventDeleted $event)
    {
        //
    }
}
