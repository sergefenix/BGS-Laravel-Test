<?php

namespace App\Listeners;

use App\Http\Controllers\LogMessageController;
use Illuminate\Support\Facades\Queue;

class LogSendingMessage
{
    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle(): void
    {
        Queue::push(LogMessageController::class,
            ['message' => "New Email"]);
    }
}
