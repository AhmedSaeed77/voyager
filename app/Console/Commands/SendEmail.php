<?php

namespace App\Console\Commands;
use App\Jobs\SendEmailJob;
use App\Models\User;
use Illuminate\Console\Command;

class SendEmail extends Command
{
    protected $signature = 'app:send-email';

    protected $description = 'Command description';

    public function handle()
    {
        $users = User::all();
        $details = [
            'title' => 'Hello!',
            'body' => 'This is a notification email.'
        ];
        $chunkSize = 50;

        $users->chunk($chunkSize)->each(function ($chunk) use ($details) {
            \Log::info("Sending email to chunk of users.");
            dispatch(new SendEmailJob($chunk->toArray(),$details));
        });
    }
}
