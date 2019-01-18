<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'screen_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function followings(){
        return $this->hasManyThrough('App\User', 'App\Follower', 'user_id', 'id', 'id', 'following_id');
    }

    public function followers(){
        return $this->hasManyThrough('App\User', 'App\Follower', 'following_id', 'id', 'id', 'user_id');
    }

    public function isFollowing(){
        $isFollowing = Follower::where('user_id', Auth::user()->id)->where('following_id', $this->id)->first();
        return $isFollowing;
    }

    public function isFollower(){
        $isFollower = Follower::where('user_id', $this->id)->where('following_id', Auth::user()->id)->first();
        return $isFollower;
    }

    public function countFollowing(){
        $id = $this->id;
        $count = Follower::where('user_id',$id)->count();
        return $count;
    }

    public function countFollower(){
        $id = $this->id;
        $count = Follower::where('following_id',$id)->count();
        return $count;
    }

    public function posts(){
        return $this->hasMany('App\Post', 'author_id', 'id');
    }

}
