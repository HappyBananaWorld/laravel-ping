<?php

namespace App\Listeners;

use App\Events\DebugCalled;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ShowDebugListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(DebugCalled $event): void
    {
//        dd($event);
    }
}
