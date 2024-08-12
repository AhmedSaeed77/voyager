<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VideoController extends Controller
{

    public function create()
    {
        return view('video');
    }

    public function store(Request $request)
    {
        $request->validate([
                                'video' => 'required|mimes:mp4,avi,mov|max:20480', // max size in kilobytes
                            ]);

        if ($request->file('video')->isValid())
        {
            $path = $request->file('video')->store('videos', 'public');
            return $path;
           \App\Models\Video::create(['video' => $path]);
            // Save the path to the database if necessary

            return redirect()->back()->with('success', 'Video uploaded successfully!');
        }

        return redirect()->back()->with('error', 'Failed to upload video.');
    }

    public function show()
    {
        $video = \App\Models\Video::find(1);
        return view('video2', compact('video'));
    }
}
