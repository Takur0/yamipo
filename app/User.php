<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Follower;
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
    
    public function followers(){
        return $this->hasManyThrough('User', 'Follower', 'following_id', 'id', 'id', 'user_id');
    }

    public function following(){
        return $this->hasManyThrough('User', 'Follower', 'user_id', 'id', 'id', 'user_id');
    }

    public function isFollowing(){
        $isFollowing = Follower::where('user_id',Auth::user()->id)->where('following_id',$this->id)->first();
        return $isFollowing;
    }

    public function isFollower($id){
        $follower = User::where('id',$id)->first();
        return $follower;
    }

    public function countFollower(){
        $id = $this->id;
        $count = Follower::where('following_id',$id)->count();
        return $count;
    }

}
