<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class NotificationController extends Controller
{
    public function readAll() {
        foreach (Auth::user()->unreadNotifications as $notification) {
            $notification->markAsRead();
        }
        
        return redirect()->back();
    }
}
