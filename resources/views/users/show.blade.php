@extends('layouts.default')

@section('title', $user->screen_name.'\'s posts')

@section('content')

    <div class="user-info">
            @if($user->profile_image_url == null)
            <img class="user-img" src="/image/author-img.png">
            @else
            <img class="user-img" src="{{$user->profile_image_url}}">
            @endif
        <div class="user-text">
            <p class="user-name">{{"@".$user->screen_name}}</p>
            <p class="user-hitokoto-and-location">
                <span class="user-hitokoto">
                    {{$user->hitokoto}} 
                </span>
                <span class="user-location">
                    <i class="fas fa-map-marker-alt"></i> {{$user->location}}
                </span>
            </p>
            <p class="user-sns">
                <a href=""><i class="fab fa-twitter"></i></a>
                <a href=""><i class="fab fa-github"></i></a>
                <a href=""><i class="fab fa-youtube"></i></a>
                <a href=""><i class="fab fa-amazon"></i></a>
                <a href=""><i class="fas fa-rss"></i></a>
            </p>
        </div>
        <a href="/follower/{{$user->screen_name}}">followers {{$user->countFollower()}}</a>
        <a href="/following/{{$user->screen_name}}">followings {{$user->countFollowing()}}</a>

        @guest
        <div class="follow-button-container">
            <a href="/login"><button class="follow-button">follow</button></a>
        </div>

        @else
            @if(Auth::user() == $user)
                <div class="follow-button-container">
                    <a href="/user/myprofile/edit"><button href="/user/myprofile/edit" class="follow-button">Profile Edit</button></a>
                </div>    
            @else
            <div class="follow-button-container">
                @if($user->isFollowing())
                <form action="{{$user->id}}/unfollow" method="post">
                {{ csrf_field() }}
                {{method_field('delete')}}
                <input type="submit" class="follow-button" value="Unfollow">
                </form>
                @else
                <form action="{{$user->id}}/follow" method="post">
                {{ csrf_field() }}
                <input type="submit" class="follow-button" value="Follow">
                </form>
                @endif
            </div>
            @endif
        @endguest
    </div>

        @forelse($posts as $post)
        <div class="colorful">
            <p>{!! nl2br(e($post->body)) !!}</p>
        </div>
        <div class="created-at">{{ $post->created_at }}</div>

        @empty
        <div class="colorful">
            <p>No Post...</p>
        </div>
        <div class="created-at">{{ $post->created_at }}</div>
        @endforelse


@endsection