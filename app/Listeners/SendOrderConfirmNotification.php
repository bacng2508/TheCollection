<?php

namespace App\Listeners;

use App\Notifications\OrderConfirm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class SendOrderConfirmNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $event->order->user->notify(new OrderConfirm($event->order));
        // Notification::send($users, new OrderConfirm($event->order));
        // Auth::user()->notify(new OrderConfirm($event->order));
    }
}
