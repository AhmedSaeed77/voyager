<?php

namespace App\Http\Controllers;
use Stevebauman\Location\Facades\Location;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Box;

class LocationController extends Controller
{
    public function index(Request $request)
    {
        $ip = '192.168.1.1';
        // $ip = $request->ip();
        $currentUserInfo = Location::get($ip);
        return view('user', compact('currentUserInfo'));
    }

    public function getUserInfo(Request $request)
    {
        return view('user2');
    }

    public function store_coordinates(Request $request)
    {
        return $request;
    }

    function createSlug($text)
    {
        $text = mb_strtolower($text, 'UTF-8');
        $text = preg_replace('/[^a-z0-9_\s-]/', '', $text);
        $text = preg_replace('/[\s-]+/', '-', $text);
        $text = $this->transliterateArabic($text);
        $text = trim($text, '-');
        return $text;
    }

    function transliterateArabic($text)
    {
        $arabicMap = [
                        'ا' => 'a', 'أ' => 'a', 'إ' => 'i', 'آ' => 'aa', 'ء' => 'a', 'ؤ' => 'u', 'ئ' => 'e',
                        'آ' => 'aa', 'آ' => 'a', 'أ' => 'a', 'ؤ' => 'u', 'ئ' => 'e', 'ء' => 'a', 'ب' => 'b',
                        'ة' => 't', 'ت' => 't', 'ث' => 'th', 'ج' => 'j', 'ح' => 'h', 'خ' => 'kh', 'د' => 'd',
                        'ذ' => 'th', 'ر' => 'r', 'ز' => 'z', 'س' => 's', 'ش' => 'sh', 'ص' => 's', 'ض' => 'd',
                        'ط' => 't', 'ظ' => 'z', 'ع' => 'a', 'غ' => 'gh', 'ف' => 'f', 'ق' => 'q', 'ك' => 'k',
                        'ل' => 'l', 'م' => 'm', 'ن' => 'n', 'ه' => 'h', 'و' => 'w', 'ي' => 'y', 'ى' => 'a',
                        'ة' => 'a', 'ى' => 'a', 'ي' => 'y',
                    ];

        $text = strtr($text, $arabicMap);
        return $text;
    }

    public function slug()
    {

        $englishText = "Hello WORLD";
        $arabicText = "مرحبا بكم";
        $englishSlug = $this->createSlug($englishText);
        $arabicSlug = $this->createSlug($arabicText);
        toastr()->success('Data saved successfully!');
        toastr()->error('Oops! Something went wrong!');
        toastr()->warning('Are you sure want to proceed ?');
        // return [
        //             'English Slug' => $englishSlug,
        //             'Arabic Slug' => $arabicSlug,
        //         ];
        return back();
    }

    public function test()
    {
        return view('user3');
    }

    public function teststore(Request $request)
    {
//        return $request->input();
        Box::create(['name' => $request->name , 'desription' => $request->description]);
        return back();
    }

}
