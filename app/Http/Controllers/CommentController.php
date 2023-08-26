<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function comment(Request $request){
        $post_id = $request->post_id;

        if(Auth::check()){
            $comment = new Comment();
            $comment->post_id = $post_id;
            $comment->comments = $request->comment;
            $comment->user_id = Auth::user()->id;
            $comment->save();
            return response()->json([
                'status'=>200,
                'meassage'=>'Comment Posted Successfully'
            ]);
        }else{
            return response()->json([
                'status'=>500,
                'meassage'=>'Somthing went wroung'
            ]); 
        } 
    }

    public function commentEdit(Request $request,$id){
        $commentEdit = Comment::find($id);
        if(Auth::check() && $commentEdit->user_id == Auth::user()->id){
            $commentEdit->comments = $request->comments;
            $commentEdit->save();
            return response()->json([
                'status'=> 200,
                'message'=>"You have Successfully Edit Your Comment"
            ]);
        }else{
            return response()->json([
                'status'=> 500,
                'message'=>"You Can't Edit this Comment"
            ]);
        }
    }

    public function commentDelete($id){
        $commentEdit = Comment::find($id);
        if(Auth::check() && $commentEdit->user_id == Auth::user()->id){
            $commentEdit->delete();
            return response()->json([
                'status'=> 200,
                'message'=>"You have Successfully Delete Your Comment"
            ]);
        }else{
            return response()->json([
                'status'=> 500,
                'message'=>"You Can't Delete this Comment"
            ]);
        }
    }
}
