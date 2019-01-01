@extends('layouts.default')

@section('title', 'all posts')

@section('content')


@forelse($posts as $post)
<div class="author-info">
        @if($post->profile_image_url == null)
        <img class="author-img" src="/image/author-img.png">
        @else
        <img class="author-img" src="{{$post->profile_image_url}}">
        @endif
<a href="/user/{{$post->author_name}}"><p class="author-name"><span>@</span>{{$post->author_name}}</p></a>
</div>

<div class="colorful">
    <p>{!! nl2br(e($post->body)) !!}</p>
</div>
<div class="created-at">{{ $post->created_at }}</div>

@empty
<div class="colorful">
    <p>No Post...</p>
</div>
@endforelse


@endsection