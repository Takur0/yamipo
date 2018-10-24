@extends('layouts.default')

@section('title', $user->screen_name.'\'s post')

@section('content')

    <div class="user-info">
        <img class="user-img" src="/image/author-img.png">
        <div class="user-text">
            <p class="user-name">{{"@".$user->screen_name}}</p>
            <p class="user-hitokoto">
                {{$user->hitokoto}} 
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
        <div class="follow-button-container">
            <button class="follow-button">follow</button>
        </div>
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