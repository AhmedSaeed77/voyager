<?php

namespace App\Http\Controllers;
use App\Models\Deposit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\DepositSuccessful;

class DepositController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }


    public function deposit(Request $request){
        $deposit = Deposit::create([
                                    'user_id' => 1,
                                    'amount'  => 45
                                ]);
        User::find(1)->notify(new DepositSuccessful($deposit->amount));

        return 'Your deposit was successful!';
    }

    public function markAsRead(){
        User::find(1)->unreadNotifications->markAsRead();
        return redirect()->back();
    }
}
