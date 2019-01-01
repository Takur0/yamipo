@extends('layouts.default')

@section('title', $user->screen_name.'\'s followers')

@section('content')


    @forelse($follows as $follow)
    <div class="user-info">
        @if($user->isFollower($follow->user_id)->profile_image_url == null)
        <img class="user-img" src="/image/author-img.png">
        @else
        <img class="user-img" src="{{$user->isFollower($follow->user_id)->profile_image_url}}">
        @endif
        <div class="user-text">
            <p class="user-name">{{"@".$user->isFollower($follow->user_id)->screen_name}}</p>
        </div>
        @guest
            <div class="follow-button-container">
                <button href="/login" class="follow-button">follow</button>
            </div>

        @else
            @if(Auth::user() == $user->isFollower($follow->user_id))
                <div class="follow-button-container">
                    <a href="/user/myprofile/edit"><button href="/user/myprofile/edit" class="follow-button">Profile Edit</button></a>
                </div>    
            @else
            <div class="follow-button-container">
                @if($user->isFollower($follow->user_id)->isFollowing())
                <form action="/user/{{$user->isFollower($follow->user_id)->id}}/unfollow" method="post">
                {{ csrf_field() }}
                {{method_field('delete')}}
                <input type="submit" class="follow-button" value="Unfollow">
                </form>
                @else
                <form action="/user/{{$user->isFollower($follow->user_id)->id}}/follow" method="post">
                {{ csrf_field() }}
                <input type="submit" class="follow-button" value="Follow">
                </form>
                @endif
            </div>
            @endif
        @endguest
    </div>
    @empty
    No Follower
    @endforelse



@endsection