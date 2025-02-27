<?php

namespace App\Notifications;

use App\Models\OrderItem;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class OrderConfirm extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $order;

    public function __construct($order)
    {
        $this->order = $order;
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
        $orderItems = OrderItem::where('order_id', $this->order->id)->get();

        return (new MailMessage)
            ->subject('The Collection - Xác nhận đơn hàng')
            ->view('mail.order-confirm',['order' => $this->order, 'orderItems' => $orderItems]);
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Đơn hàng mới',
            'message' => 'Người dùng ' . $this->order->fullname . 'đã tạo đơn hàng: ' . $this->order->order_code,
        ];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'title' => 'Đơn hàng mới',
            'message' => 'Người dùng ' . $this->order->fullname . 'đã tạo đơn hàng: ' . $this->order->order_code,
        ];
    }

    public function databaseType(object $notifiable): string
    {
        return 'order-confirm';
    }
}
