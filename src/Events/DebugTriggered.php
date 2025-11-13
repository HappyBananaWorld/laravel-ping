<?php

namespace LaravelPing\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DebugTriggered implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $payload;
    public function __construct($payload)
    {
        $this->payload = $payload;
    }

    public function broadcastOn(): array
    {
        $channel = config('live-debugger.channel', 'debug-triggered');
        return [new Channel($channel)];
    }

    public function broadcastAs(): string
    {
        return 'debug-called';
    }
}
