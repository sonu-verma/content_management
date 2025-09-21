<?php

namespace App\Listeners\Users;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateUserChannel
{
   
    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $event->user->channel()->create([
            'title' => $event->user->name,
            'description' => 'This is ' . $event->user->name . ' channel',
        ]);
    }
}
