<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class Announcement extends Notification
{
    protected $broadcast;

    /**
     * Create a new notification instance.
     */
    public function __construct($broadcast)
    {
        $this->broadcast = $broadcast;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(): array
    {
        return ['database'];
    }

    // this is saved on notifications table on column "data"
    public function toDatabase(): array
    {
        return [
            "broadcast_id" => $this->broadcast->id,
            "title" => $this->broadcast->title,
            "message" => $this->broadcast->message,
        ];
    }
}
