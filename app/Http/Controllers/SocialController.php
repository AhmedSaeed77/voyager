<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;
use App\Http\Traits\Responser;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    use Responser;

    public function redirect($provider)
    {
        $link = Socialite::with($provider)->stateless()->redirect()->getTargetUrl();
        return redirect($link);
    }

    public function callback($provider)
    {
        $userSocial = Socialite::with($provider)->stateless()->user();
        $user = User::where('email', $userSocial->getEmail())->first();
        if ($user)
        {
            return $this->responseSuccess(message: __('messages.Successfully authenticated'), data: new UserResource($user, true));
        }
        else
        {
            $user = User::create([
                                                        'name' => $userSocial->getName(),
                                                        'email' => $userSocial->getEmail(),
                                                        'avatar' => $userSocial->getAvatar(),
                                                        'provider_id' => $userSocial->getId(),
                                                        'provider' => $provider,
                                                    ]);
            return $this->responseSuccess(message: __('messages.Successfully authenticated'), data: new UserResource($user, true));
        }
    }
}
