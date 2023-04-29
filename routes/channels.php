<?php

use App\Models\ChatBox;
use Illuminate\Support\Facades\Broadcast;

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

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
Broadcast::channel('private.chat.{chatbox_id}', function ($user, $chatbox_id) {
    $chatbox = ChatBox::where('id', $chatbox_id)
        ->first();
    if ($chatbox && ($user->id == $chatbox->customer_id || $user->id == $chatbox->employee_user_id)) {
        return ['id' => $user->id];
    }
});
