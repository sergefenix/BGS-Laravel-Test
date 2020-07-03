<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Bus\Queueable;
use App\Mail\NewParticipant;
use App\User;

class SendMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @param NewParticipant $email
     *
     * @param User           $user
     *
     * @return void
     */
    public function handle(NewParticipant $email, User $user): void
    {
        Log::info('Email was send');

       // Mail::to($user)->send($email);
    }
}
