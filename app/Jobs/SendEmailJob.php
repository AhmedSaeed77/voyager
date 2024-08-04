<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Http\Mail\NotifyMail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $users;
    protected $details;

    public function __construct($users, $details)
    {
        $this->users = $users;
        $this->details = $details;
    }

    public function handle()
    {
        foreach ($this->users as $user)
        {
            Mail::to($user['email'])->send(new NotifyMail($this->details));
            sleep(3);
        }

    }
}
