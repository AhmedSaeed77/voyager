<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use App\Models\Image;
use Illuminate\Http\Request;

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
}
