<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function upload(Request $request){
        $data = $request->validate([
                                'video' => ['required','file', 'max:50000', 'mimes:avi,mpeg,quicktime,mp4,mkv'],
                                'title' => ['required', 'string', 'regex:/[\w\s]/'],
                                'category' => ['required', 'string', 'alpha'],
                            ]);
        
        $result = 0;
        if($request->hasFile('video')){
            $file_path = $request->file('video')->store('public/videos');
            $file_path = str_replace('public/', '', $file_path); 

            $video = new Video();
            $video->user_id = auth()->user()->id;
            $video->user_video = $file_path;
            $video->title = $data['title'];
            $video->category = $data['category'];
            $result = $video->save();
        }

        if($result == 1){
            $request->session()->flash('success', 'The video has been successfully uploaded.');
        }
        else{
            $request->session()->flash('fail', 'The video uploading has been failed');
        }

        return redirect()->back();
    }
}
