@extends('layouts.default')

@section('title', 'Edit profile')
@section('content')
    <form action="/user/{{$user->screen_name}}/update" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{method_field('patch')}}
        <div class="user-info">
            @if($user->profile_image_url == null)
            <img class="user-img" src="/image/author-img.png">
            @else
            <img class="user-img" src="{{$user->profile_image_url}}">
            @endif
            <div class="user-text">
                <input class="user-img-form" type="file" name="image">
                <span class="user-name-at">@</span><input type="text" name="user_name" class="user-name" value="{{$user->screen_name}}">
                {{-- <p class="user-name">{{"@".$user->screen_name}}</p> --}}
                <p class="user-hitokoto-and-location">
                    <input type="text" name="user_hitokoto" class="user-hitokoto" value="{{$user->hitokoto}}">
                    {{-- {{$user->hitokoto}}  --}}
                    <i class="fas fa-map-marker-alt"></i><input type="text" class="user-location" name="user_location" value="{{$user->location}}">
                </p>
                <p class="user-sns">
                    <a href=""><i class="fab fa-twitter"></i></a>
                    <a href=""><i class="fab fa-github"></i></a>
                    <a href=""><i class="fab fa-youtube"></i></a>
                    <a href=""><i class="fab fa-amazon"></i></a>
                    <a href=""><i class="fas fa-rss"></i></a>
                </p>
            </div>
            <div class="follow-button-container">
                <input class="follow-button" type="submit" value="Update">
            </div>
        </div>
    </form>
@endsection