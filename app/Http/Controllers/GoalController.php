<?php

namespace App\Http\Controllers;
use App\Models\Goal;
use Illuminate\Http\Request;

class GoalController extends Controller
{
    public function index()
    {

    }

    public function create()
    {
        return view('goals.create');
    }

    public function store(Request $request)
    {
        $blog = Goal::create(['name' => $request->name]);
        foreach($request->images as $image)
        {
            $filename = $image->getClientOriginalName();
            $filename = str_replace(" ","",$filename);
            $image->move('images/goals', $filename);
            $blog->images()->create([
                                        'url' => $filename,
                                    ]);
        }
        return redirect()->route('goals.index');
    }
}
