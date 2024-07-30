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
        $users = User::all();
        $details = [
                        'title' => 'Hello!',
                        'body' => 'This is a notification email.'
                    ];

        foreach ($users as $user)
        {
            \Log::info("message");
            SendEmailJob::dispatch($user, $details);
        }

        return response()->json(['status' => 'Emails are being sent!']);
    }

}
