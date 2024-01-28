<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserRegisteredHandler
{
    /**
     * Create the event listener.
     *
     * @return void
     */

    public function handle(UserRegistered $event)
    {
        $user = $event->user;

        // Отправить приветственное сообщение
        $user->sendWelcomeEmail();


    }
}
