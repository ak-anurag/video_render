<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //save comment
    public function saveComment(Request $request){
        $data = $request->validate([
                            'vid' => ['required', 'numeric'],
                            'comment' => ['required', 'string'],
                        ]);

        $com = new Comment();
        $com->video_id = $data['vid'];
        $com->comment = $data['comment'];
        $result = $com->save();
        
        return redirect()->back();
    }
}
