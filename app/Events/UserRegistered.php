<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserRegistered implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    /**
     * Create a new event instance.
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('user-registered')
        ];
    }

    // public function broadcastAs()
    // {
    //     return 'UserRegistered';
    // }

    public function broadcastWith(): array
    {
        return [
            'title' => 'Người dùng đăng ký mới',
            'message' => 'Người dùng ' . $this->user->name . ' đã đăng ký tài khoản.',
            'created_at' => date('H:i d-m-Y ', strtotime($this->user->created_at)),
        ];
    }
}
