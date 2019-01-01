<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Follower;
use Auth;
use Log;
use \App\Http\Requests\UploaderRequest;
use \Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Http\Requests\ItemRequest;


class UsersController extends Controller
{
    //

    public function follower($screen_name){
        $user = User::where('screen_name', $screen_name)->first();
        // $followers = $user->followers();
        $follows = Follower::where('following_id', $user->id)->get();
        // Log::debug($follows);

        // $followers = null;
        // foreach($follows as $follow){
        //     $followers = User::where('id',$follow->user_id)->get();
        // }

        // return view('users.follower')->with('followers', $followers)->with('user', $user);
        return view('users.follower')->with('follows', $follows)->with('user', $user);

    }

    public function profile($screen_name){
    	$user = User::where('screen_name', $screen_name)->first();
        $posts = Post::where('author_id', $user->id)->latest()->get();
        return view('posts.profile')->with('posts', $posts)->with('user', $user);
    }

    public function show($screen_name){
        $user = User::where('screen_name', $screen_name)->first();
        $posts = Post::where('author_id', $user->id)->latest()->get();
        return view('users.show')->with('posts', $posts)->with('user', $user);
    }

    public function new(){
    }

    public function edit(){
        $user = User::where('id', Auth::user()->id)->first();
        return view('users.edit')->with('user', $user);
    }

    public function update(Request $request){
        $user = User::where('id', Auth::user()->id)->first();
        $params = $request->validate([
            'image' => 'file|image|max:4000',
        ]);
        if($params != null){
            $file = $params['image'];
            $image = \Image::make(file_get_contents($file->getRealPath()));
            $file_path = '/image/'.$file->hashName();
            $image->save(public_path().$file_path);
            $user->profile_image_url = $file_path;
        }
        $user->screen_name = $request->user_name;
        $user->hitokoto = $request->user_hitokoto;
        $user->location = $request->user_location;
        $user->save();
        return redirect() -> action(
            'UsersController@show', ['screen_name'=> $user->screen_name]
        );
    }

    public function follow(User $user){
        $follower = Auth::user();
        $follow = new Follower();
        $follow->user_id = $follower->id;
        $follow->following_id = $user->id;
        $follow->save();
        return back();
        // return redirect() -> action(
        //     'UsersController@show', ['screen_name'=> $user->screen_name]
        // );
    }

    public function unfollow(User $user){
        $follower = Auth::user();

            $unfollow = Follower::where('user_id', Auth::user()->id)->where('following_id', $user->id) ;
            $unfollow->delete();
            return back();
            // return redirect() -> action(
            //     'UsersController@show', ['screen_name'=> $user->screen_name]
            // );

    }

}
