<?php

namespace App\Notifications;

use App\Models\OrderItem;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Carbon;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class OrderChangeStatus extends Notification implements ShouldQueue
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
        return ['mail', 'database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $orderItems = OrderItem::where('order_id', $this->order->id)->get();

        return (new MailMessage)
            ->subject('The Collection - Cập nhật trạng thái đơn hàng')
            ->view('mail.order-change-status',['order' => $this->order, 'orderItems' => $orderItems]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Cập nhật trạng thái đơn hàng',
            'message' => 'Đơn hàng ' . $this->order->order_code . 'đã thay đổi trạng thái thành ' . $this->order->order_status,
        ];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'title' => 'Cập nhật trạng thái đơn hàng',
            'message' => 'Đơn hàng ' . $this->order->order_code . 'đã thay đổi trạng thái thành ' . $this->order->order_status,
        ];
    }

    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'title' => 'Cập nhật trạng thái đơn hàng',
            'message' => 'Đơn hàng ' . $this->order->order_code . 'đã thay đổi trạng thái thành ' . $this->order->order_status,
            'created_at' => date('H:i d-m-Y ', strtotime(Carbon::now())),
        ]);
    }

    public function databaseType(object $notifiable): string
    {
        return 'order-change-status';
    }
}
