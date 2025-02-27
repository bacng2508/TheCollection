<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index() {
        $notificationList = Notification::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.notification.index', compact('notificationList'));
    }

    public function readAll() {
        $unReadNotifications = Notification::where('read_at', null)->get();
 
        foreach ($unReadNotifications as $unReadNotification) {
            $unReadNotification->update([
                'read_at' => now(),
            ]);
        }
        
        return redirect()->back();
    }
}
