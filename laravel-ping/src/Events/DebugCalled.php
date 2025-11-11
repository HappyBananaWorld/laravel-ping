<?php

namespace YourVendor\LiveDebugger\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DebugCalled implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $p;

    public function __construct($p)
    {
        $this->p = $p;
    }

    public function broadcastOn(): array
    {
        $channel = config('live-debugger.channel', 'channel-name');
        return [new Channel($channel)];
    }

    public function broadcastAs(): string
    {
        return 'debug-called';
    }
}
