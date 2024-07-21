<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function store()
    {
        $user = User::create([
                                'name' => 'John Doe',
                                'email' => 'john2802@example.com',
                                'password' => '123456789',
                            ]);
        
        // $profile = $user->profile()->create([
        //                                         'bio' => 'A brief bio about John Doe',
        //                                         'address' => '123 Main St, Cityville',
        //                                     ]);
        $profile = Profile::create([
                                        'user_id' => $user->id,
                                        'bio' => 'A brief bio about John Doe',
                                        'address' => '123 Main St, Cityville',
                                    ]);


        return 'done';
    }
}
