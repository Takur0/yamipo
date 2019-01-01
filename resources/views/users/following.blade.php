@extends('layouts.default')

@section('title', $user->screen_name.'\'s followings')

@section('content')


    @forelse($followings as $following)
    <div class="user-info">
        <a href="/user/{{$following->screen_name}}">
            @if($following->profile_image_url == null)
            <img class="user-img" src="/image/author-img.png">
            @else
            <img class="user-img" src="{{$following->profile_image_url}}">
            @endif
        </a>
        <div class="user-text">
            <a href="/user/{{$following->screen_name}}" class="user-name">{{"@".$following->screen_name}}</a>
        </div>
        @guest
            <div class="follow-button-container">
                <a href="/login"><button class="follow-button">follow</button></a>
            </div>

        @else
            @if(Auth::user()->id == $following->id)
                <div class="follow-button-container">
                    <a href="/user/myprofile/edit"><button href="/user/myprofile/edit" class="follow-button">Profile Edit</button></a>
                </div>    
            @else
            <div class="follow-button-container">
                @if($following->isFollowing())
                <form action="/user/{{$following->id}}/unfollow" method="post">
                {{ csrf_field() }}
                {{method_field('delete')}}
                <input type="submit" class="follow-button" value="Unfollow">
                </form>
                @else
                <form action="/user/{{$following->id}}/follow" method="post">
                {{ csrf_field() }}
                <input type="submit" class="follow-button" value="Follow">
                </form>
                @endif
            </div>
            @endif
        @endguest
    </div>
    @empty
    No Followings
    @endforelse



@endsection