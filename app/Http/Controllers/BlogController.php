<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use App\Models\Image;
use App\Models\User;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Notifications\MyNotification;
use Auth;
use App\Notifications\BirthdayWish;

class BlogController extends Controller
{
    public function index()
    {

    }

    public function create()
    {
        return view('blogs.create');
    }

    public function store(Request $request)
    {
        $blog = Blog::create(['name' => $request->name]);
        foreach($request->images as $image)
        {
            $filename = $image->getClientOriginalName();
            $filename = str_replace(" ","",$filename);
            $image->move('images/blogs', $filename);
            $blog->images()->create([
                                        'url' => $filename,
                                    ]);
        }
        return redirect()->route('blogs.index');
    }

    public function getimages($id)
    {
        $blog = Blog::find($id);
        if($blog)
        {
            foreach($blog->images as $image)
            {
                $image->url = url('images/blogs/'.$image['url']);
            }
            return $blog;
        }
        else
        {
            return "not found";
        }
    }

    public function notification()
    {
        Auth::user()->notify(new MyNotification);
        return auth()->user()->unreadNotifications;
    }

    public function testmultiple(Request $request)
    {
        $data = [];

        foreach ($request->selected_option as $key => $selectedOption)
        {
            $data[] = [
                        'selected_option' => $selectedOption,
                        'input_value' => $request->input_value[$key],
                        'input_value2' => $request->input_value2[$key],
                    ];
        }
        dd($data);
    }

    public function edit()
    {
        $data[] = [
                        ['selected_option' => 'option1','input_value' => '12'],
                        ['selected_option' => 'option1','input_value' => '13'],
                        ['selected_option' => 'option1','input_value' => '15'],
                        ['selected_option' => 'option2','input_value' => '14'],
                        ['selected_option' => 'option2','input_value' => '16'],
                    ];
                    
        return view('testmultiple2',compact('data'));           
    }

    public function message()
    {
        return redirect()->back()->with(['success' => __('dashboard.Incorrect email or password')]);
        return redirect()->back()->with(['error' => __('dashboard.Incorrect email or password')]);
    }

    public function showajax(Request $request)
    {
        $offset = $request->input('offset', 0);
        $blogs = Blog::skip($offset)->take(3)->get();
        return response()->json($blogs);
    }

    public function getpageajax()
    {
        $blogs = Blog::take(3)->get();
        return view('showajax',compact('blogs'));
    }

    public function loginajax(Request $request)
    {
        return response()->json(['success' => true, 'message' => 'Login successful']);
    }

    public function usernotify(Request $request)
    {
        $user = User::find(1);
  
        $messages["hi"] = "Hey, Happy Birthday {$user->name}";
        $messages["wish"] = "On behalf of the entire company I wish you a very happy birthday and send you my best wishes for much happiness in your life.";
          
        $user->notify(new BirthdayWish($messages));
  
        dd('Done');
    }

    public function test()
    {
        $country = Country::find(1);
        $cities = $country->cities;
        return $cities;
    }

    public function searchcity(Request $request)
    {
        if($request->filled('search'))
        {
            $cities = City::search($request->search)->get();
        }
        else
        {
            $cities = City::get();
        }
          
        return view('cities', compact('cities'));
    }

    public function createCoutry()
    {
        $parentCategory = Country::find(7);
        $childCategory = $parentCategory->children()->create(['name' => 'Child Category 7']);
        return 'done';
        // $parent = Country::find(6);
        // $children = $parent->children;
        // return $children;
    }

    public function validation(Request $request)
    {
        $rules = [
            'email' => 'required|email',
        ];
    
        $customMessages = [
            'email.required' => __('validation.required'),
            'email.email' => __('validation.email'),
        ];
    
        $validatedData = $request->validate($rules, $customMessages);
        return $request->email;
    }
}
