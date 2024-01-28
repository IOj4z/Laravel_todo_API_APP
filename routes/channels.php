<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Gate;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('event.{event_id}.{user_id}', function ($user, $eventId, $userId) {
    return (int) $user->id === (int) $userId;
});

Broadcast::channel('event.created.{event_id}.{user_id}', function ($user, $eventId, $userId) {
    return (int) $user->id === (int) $userId;
});
