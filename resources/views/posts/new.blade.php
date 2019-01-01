@extends('layouts.default')

@section('title', 'New Post')

@section('content')

    <form class="create-post" method="post" action="{{ url('/post') }}">
        {{ csrf_field() }}
        <p>
        <textarea name="body" rows="4" placeholder="enter body"></textarea>
        </p>
        <p>
        <input type="submit" value="Add">
        </p>
    </form>

@endsection
