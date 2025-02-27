<?php
 
namespace App\View\Composers\Admin;
 
use Illuminate\View\View;
use App\Models\Notification;

class NotificationComposer
{
    /**
     * Create a new profile composer.
     */
    // public function __construct(
    //     protected UserRepository $users,
    // ) {}
 
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $notifications = Notification::latest()->limit(5)->get();
        $totalNotifications = Notification::count();
        $unReadNotifications = Notification::where('read_at', null)->count();
        $hasNewNotification = Notification::where('read_at', null)->count() != 0;

        $view->with('notifications', $notifications);
        $view->with('totalNotifications', $totalNotifications);
        $view->with('unReadNotifications', $unReadNotifications);
        $view->with('hasNewNotification', $hasNewNotification);
    }
}