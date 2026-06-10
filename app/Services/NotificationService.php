<?php

namespace App\Services;

use App\Models\Notification;
use App\Events\NotificationCreated;
use Illuminate\Support\Str;

class NotificationService
{
    /**
     * Send a notification and broadcast it to the user.
     *
     * @param int $userId The recipient's user ID
     * @param string $type The notification type (e.g. 'order_update', 'system')
     * @param string $title The notification title
     * @param string $body The notification body text
     * @param array $data Optional JSON data payload
     * @return Notification
     */
    public static function send($userId, $type, $title, $body, $data = [])
    {
        $notification = Notification::create([
            'id' => Str::uuid()->toString(),
            'user_id' => $userId,
            'type' => $type,
            'title' => $title,
            'body' => $body,
            'data' => $data,
        ]);

        // Broadcast the event
        broadcast(new NotificationCreated($notification));

        return $notification;
    }
}
