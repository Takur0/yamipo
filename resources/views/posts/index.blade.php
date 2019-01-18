@extends('layouts.default')

@section('title', 'all posts')

@section('content')


@forelse($posts as $post)
    <div class="post">
        <div class="author-info">
                @if($post->user()->first()->profile_image_url == null)
                <img class="author-img" src="/image/author-img.png">
                @else
                <img class="author-img" src="{{$post->user()->first()->profile_image_url}}">
                @endif
        <a href="/user/{{$post->user()->first()->screen_name}}" class="author-name"><span>@</span>{{$post->user()->first()->screen_name}}</a>
        </div>

        <div class="colorful {{$post->effect}}">
            <p>{!! nl2br(e($post->body)) !!}</p>
        </div>
        <div class="created-at"><a href="/post/{{$post->id}}">{{ $post->created_at }}</a></div>
    </div>
@empty
    <div class="post">
        <div class="colorful">
            <p>No Post...</p>
        </div>
    </div>
@endforelse


@endsection