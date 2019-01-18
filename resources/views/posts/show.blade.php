@extends('layouts.default')

@section('title', 'post ['.$post->created_at.']')

@section('content')


    <div class="post">
        <div class="author-info">
            @if($post->user()->first()->profile_image_url == null)
                <img class="author-img" src="/image/author-img.png">
            @else
                <img class="author-img" src="{{$post->user()->first()->profile_image_url}}">
            @endif
            <a href="/user/{{$post->user()->first()->screen_name}}" class="author-name"><span>@</span>{{$post->user()->first()->screen_name}}</a>
            @if($post->user()->first() == Auth::user())
            <div class="edit-post-a-container">
                <a href="/post/{{$post->id}}/edit" class="edit-post-a">[Edit]</a>
            </div>
            @endif
        </div>

        <div class="colorful {{$post->effect}}">
            <p>{!! nl2br(e($post->body)) !!}</p>
        </div>
        <div class="created-at">{{ $post->created_at }}</div>
    </div>


@endsection