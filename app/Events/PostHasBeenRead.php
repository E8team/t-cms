<?php

namespace App\Events;

use App\Models\Post;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class PostHasBeenRead extends BaseEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $post;
    public $ip;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Post $post, $ip)
    {
        $this->post = $post;
        if($ip == '::1') $ip = '127.0.0.1';
        $this->ip = $ip;
    }
}
