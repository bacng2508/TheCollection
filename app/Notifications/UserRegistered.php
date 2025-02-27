<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserRegistered extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {   
        return (new MailMessage)
            ->subject('The Collection - Chào mừng bạn')
            ->view('mail.welcome-client',['userInfo' => ['email' => $this->user->email, 'name' => $this->user->name]]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Người dùng đăng ký mới',
            'message' => 'Người dùng ' . $this->user->name . ' đã đăng ký tài khoản.',
        ];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'title' => 'Người dùng đăng ký mới',
            'message' => 'Người dùng ' . $this->user->name . ' đã đăng ký tài khoản.',
        ];
    }

    public function databaseType(object $notifiable): string
    {
        return 'user-register';
    }
}
