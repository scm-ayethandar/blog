@extends('layouts.master')

@section('title')
    {{ $post->title }}
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <h3>{{ $post->title }}</h3>
        <p>Post by <b>{{ $post->author }}</b> on <i>{{$post->created_at->format('M d, Y')}}</i></p>
        <p>{{ $post->body }}</p>

        <a href="/posts" class="btn btn-outline-secondary">Go Home</a>
    </div>
</div>
@endsection 