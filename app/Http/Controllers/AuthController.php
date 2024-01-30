<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Services\Mutual\GetService;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;
use App\Repository\UserRepositoryInterface;

class AuthController extends Controller
{
    protected GetService $get;
    protected UserRepositoryInterface $userRepository;

    public function __construct(GetService $get,UserRepositoryInterface $userRepository)
    {
        $this->get = $get;
        $this->userRepository = $userRepository;
    }

    public function login(Request $request)
    {
        try
        {
            $user = User::where('email',$request->email)->first();
            if (!$user || !Hash::check($request->password,$user->password))
            {
                return response()->json('Invalid_email_or_password', 401);
            }
            return $user->generateToken();
        }
        catch (\Exception $e)
        {
            return response()->json($e->getMessage(), 401);
        }
    }

    public function getAllUsers()
    {
        return $this->get->handle(UserResource::class , $this->userRepository);
    }
}
