<?php

namespace App\Http\Controllers;

class NotificationController extends Controller
{
    /*
     * Mark all the notifications for the current session's user as read.
     */
    public function mark_all_as_read(): void
    {
        auth()->user()->unreadNotifications->markAsRead();
    }

    /*
     * Mark the notification with `$id` for the current session's user as read.
     */
    public function mark_as_read(string $id): void
    {
        auth()->user()->unreadNotifications->where('id', $id)->markAsRead();
    }
}
