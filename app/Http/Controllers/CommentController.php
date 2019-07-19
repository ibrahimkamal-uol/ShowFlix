<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Test;

class CommentController extends Controller
{
    public function store(Request $request)
    {

        $comment = new Comment();
        $comment->body = $request->body;
        $comment->test_id = $request->test_id;
        $comment->user_id = auth()->user()->id;
        $comment->save();
     
        return response()->json(['success'=>'Comment is Added Successfully','id'=>$comment->id,'body'=>$comment->body]);
    
}

 public function update(Request $request)
    {

        $comment = Comment::FindorFail($request->id);
        $comment->body = $request->body;
        $comment->test_id = $request->test_id;
        $comment->user_id = auth()->user()->id;
        $comment->save();
     
        return response()->json(['success'=>'Comment is updated Successfully','id'=>$comment->id,'body'=>$comment->body]);
    
}

    public function delete(Request $request)
    {
        
        $comment= Comment::find($request->id);
        $comment->delete();
        return response()->json(['success','Comment is Successfully Deleted']);
    }
}