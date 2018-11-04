<?php

namespace App\Observers;

use App\Models\Message;
use App\Notifications\NewMessageNotification;
use Illuminate\Support\Facades\Notification;

class MessageObserver
{
    public function created(Message $message)
    {
        if ($notify_email = config('contact.notify_email', '')) {
            Notification::route('mail', $notify_email)
                ->notify(new NewMessageNotification($message));
        }
    }
}