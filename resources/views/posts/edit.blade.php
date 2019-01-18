@extends('layouts.default')

@section('title', 'Edit post')

@section('content')

@if($post->user()->first() == Auth::user())
    <div class="post">
        <div class="author-info">
            @if($post->user()->first()->profile_image_url == null)
                <img class="author-img" src="/image/author-img.png">
            @else
                <img class="author-img" src="{{$post->user()->first()->profile_image_url}}">
            @endif
            <a href="/user/{{$post->user()->first()->screen_name}}" class="author-name"><span>@</span>{{$post->user()->first()->screen_name}}</a>
            <div class="edit-post-a-container">
                <form action="/post/{{$post->id}}/update" method="post" >
                {{ csrf_field() }}
                {{ method_field('patch') }}
                    <label for="effect">Effect: </label>
                    <select name="effect" id="effect-pulldown" value="{{$post->effect}}">
                        <option value="null" @if($post->effect == null) selected @endif>None</option>
                        <option value="rumble" @if($post->effect == 'rumble')selected @endif>Rumble</option>
                    </select>
                    <input class="follow-button" type="submit" value="Update">
                </form>
            </div>
        </div>

        <div class="colorful {{$post->effect}}">
            <p>{!! nl2br(e($post->body)) !!}</p>
        </div>
        <div class="created-at">{{ $post->created_at }}</div>
    </div>
@else 
<div class="post">
    <div class="colorful {{$post->effect}}">
            <p>不正なリンクです。</p>
    </div>
</div>
@endif

@endsection