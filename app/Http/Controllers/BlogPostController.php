<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogPostController extends Controller
{
    public function posts(Request $request){
        if(Auth::check()){
            $user_id = Auth::user()->id;
            $posts = Post::create([
                'post_tittle' => $request->post_tittle,
                'post_description'=>$request->post_description,
                'user_id'=>$user_id
            ]);
    
            return response()->json([
                'status'=>200,
                'message'=>'Post Created Successfully.'
            ]);
        }else{
            return response()->json([
                'status'=>500,
                'message'=>'Please login and try'
            ]);
        }
       
    }

    public function edit(Request $request , $id){
        $edit_post = Post::find($id);
        if(Auth::check() && $edit_post->user_id == Auth::user()->id){
            $edit_post->post_tittle = $request->post_tittle;
            $edit_post->post_description = $request->post_description;
            $edit_post->save();
            return response()->json([
                'status'=> 200,
                'message'=>'Post Edited Successfully'
            ]);
        }else{
            return response()->json([
                'status'=>500,
                'message'=>"You can't edit this post"
            ]);
        }
    }

    public function delete($id){
        $post_delete = Post::find($id);
        if(Auth::check() && $post_delete->user_id == Auth::user()->id){
           $post_delete->delete();

           return response()->json([
            'status'=>200,
            'message'=>'Post Deleted Successfully'
           ]);
        }else{
            return response()->json([
                'status'=>500,
                'message'=>"You can't delete the Post"
            ]);
        }
    }

    public function show(Request $request){
        $user_id = Auth::user()->id;
        if($user_id != null){
            $posts = Post::with('comment')->where('user_id',$user_id)->get();
            return response()->json([
                'status'=>200,
                'posts'=>$posts
            ]);
        }else{
            return response()->json([
                'status'=>500,
                'message'=>"You can't edit the Post"
            ]);
        }
    }
}
