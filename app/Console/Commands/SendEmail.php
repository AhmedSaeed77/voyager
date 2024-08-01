<?php

namespace App\Console\Commands;
use App\Jobs\SendEmailJob;
use App\Models\User;
use Illuminate\Console\Command;

class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::all();
        $details = [
            'title' => 'Hello!',
            'body' => 'This is a notification email.'
        ];
        foreach ($users as $user)
        {
            dispatch(new SendEmailJob($user,$details));
        }
    }
}
