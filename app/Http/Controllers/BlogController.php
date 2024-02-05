<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Notifications\MyNotification;
use Auth;

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
}
