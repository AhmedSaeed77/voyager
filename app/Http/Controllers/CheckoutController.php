<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\User;
use App\Models\UserSubscribe;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
    public function index()
    {

        // $rules = [
        //     'total_after_discount' => 'required|regex:/^\d+(\.\d{1,2})?$/',
        // ];
        // $validator = Validator::make(request()->all(), $rules, [
        //     'total_after_discount.regex' => 407,
        // ]);

        // if ($validator->fails()) {
        //     $errors = collect($validator->errors())->flatten(1)[0];
        //     if (is_numeric($errors)) {

        //         $errors_arr = [
        //             407 => 'Failed,Total after discount must be an price.',
        //         ];

        //         $code = collect($validator->errors())->flatten(1)[0];
        //         return $errors_arr[$errors];
        //     }
        //     return $validator->errors()->first();
        // }

        // $order = Payment::create([
        //     'total_price' => request()->total_after_discount,
        //     'user_id' => Auth::guard('user-api')->id(),
        // ]);


        $payMobToken = PayMobController::pay(120,2);
        // return $payMobToken;

        return response()->json(['data' => "https://accept.paymob.com/api/acceptance/iframes/855794?payment_token=$payMobToken",'message' => "تم الوصول الي لينك الدفع الالكتروني برجاء التوجهه الي عمليه الدفع لاتمام الدفع المبلغ",'code' => 200]);
//        return response()->json(['data' => "https://accept.paymob.com/api/acceptance/iframes/758783?payment_token=$payMobToken",'message' => "تم الوصول الي لينك الدفع الالكتروني برجاء التوجهه الي عمليه الدفع لاتمام الدفع المبلغ",'code' => 200]);


    }
}
