<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use App\Models\Meeting;
use App\Jobs\SendEmailJob;
use Carbon\Carbon;

class ZoomController extends Controller
{

    public function store(Request $request)
    {
        // Validate input
        $validated = $this->validate($request, [
                                                    'title' => 'required',
                                                    'start_date_time' => 'required|date',
                                                    'duration_in_minute' => 'required|numeric'
                                                ]);
        try
        {
            $meeting = $this->createMeeting($request);
            Meeting::create([
                                'meeting_id' => $meeting['id'],
                                'topic' => $meeting['topic'],
                                'start_at' => $request->start_date_time,
                                'duration' => $meeting['duration'],
                                'password' => $meeting['password'],
                                'start_url' => $meeting['start_url'],
                                'join_url' => $meeting['join_url'],
                            ]);
            return $meeting;
        }
        catch (\Exception $e)
        {
            return $e;
        }

    }

    public function createMeeting($request): array
    {

        try
        {
            $response = Http::withHeaders([
                                                'Authorization' => 'Bearer ' .self::generateToken(),
                                                'Content-Type' => 'application/json',
                                            ])
                            ->post("https://api.zoom.us/v2/users/me/meetings", [
                                    'topic' => $request->title,
                                    'type' => 2, // 2 for scheduled meeting
                                    'start_time' => Carbon::parse($request->start_date_time)->toIso8601String(),
                                    'duration' => $request->uration_in_minute,
                                ]);

            return $response->json();

        }
        catch (\Throwable $th)
        {
            throw $th;
        }
    }

    protected function generateToken(): string
    {
        try
        {
            $base64String = base64_encode(env('ZOOM_CLIENT_ID') . ':' . env('ZOOM_CLIENT_SECRET'));
            $accountId = env('ZOOM_ACCOUNT_ID');

            $responseToken = Http::withHeaders([
                "Content-Type"=> "application/x-www-form-urlencoded",
                "Authorization"=> "Basic {$base64String}"
            ])->post("https://zoom.us/oauth/token?grant_type=account_credentials&account_id={$accountId}");

            return $responseToken->json()['access_token'];

        }
        catch (\Throwable $th)
        {
            throw $th;
        }
    }

}
