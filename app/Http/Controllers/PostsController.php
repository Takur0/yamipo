<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;

class PostsController extends Controller
{
    //
    public function profile($screen_name){
    	$user = User::where('screen_name', $screen_name)->first();
        $posts = Post::where('author_id', $user->id)->latest()->get();
        return view('posts.profile')->with('posts', $posts)->with('user', $user);
    }

    public function show(){
    }

    public function create(){
    	return view('posts.create');
    }

    public function store(Request $request){
    	$post = new Post();
    	$post->author_id = 1;
    	$post->body = $request->body;
    	$post->data_type = "text";
    	$post->save();
    	return redirect('/user/Takur0');
    }
}
