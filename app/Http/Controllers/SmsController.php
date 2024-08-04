<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use App\Jobs\SendEmailJob;

class SmsController extends Controller
{

    public function sendSms($to, $message)
    {
        $this->client->messages->create($to, [
            'from' => env('TWILIO_PHONE_NUMBER'),
            'body' => $message,
        ]);
    }

    public function sendEmails()
    {
        $details = [
                        'title' => 'Hello!',
                        'body' => 'This is a notification email.'
                    ];

        $users = User::all();
        $chunkSize = 50;

        $users->chunk($chunkSize)->each(function ($chunk) use ($details) {
            \Log::info("Sending email to chunk of users.");
            SendEmailJob::dispatch($chunk->toArray(), $details);
        });

        return response()->json(['status' => 'Emails are being sent!']);
    }

}
