<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use Auth;

class PostsController extends Controller
{
    //
    public function index(){
        $posts = Post::where('id', '>=', 1)->latest()->get();
        return view('posts.index')->with('posts', $posts);
    }

    public function profile($screen_name){
    	$user = User::where('screen_name', $screen_name)->first();
        $posts = Post::where('author_id', $user->id)->latest()->get();
        return view('posts.profile')->with('posts', $posts)->with('user', $user);
    }

    public function show($id){
        $post = Post::where('id' ,$id)->first();
        return view('posts.show')->with('post', $post);
    }

    public function edit($id){
        $post = Post::where('id' ,$id)->first();
        return view('posts.edit')->with('post', $post);
    }

    public function update(Request $request, $id){
        $post = Post::where('id', $id)->first();
        $post->effect = $request->effect;
        $post->save();
        return redirect() -> action(
            'PostsController@show', ['id'=> $post->id]
        );

    }

    public function new(){
    	return view('posts.new');
    }

    public function create(Request $request){
    	$post = new Post();
    	$post->author_id = Auth::user()->id;
    	$post->body = $request->body;
    	$post->data_type = "text";
    	$post->save();
    	return redirect('/post/index');
    }
}
