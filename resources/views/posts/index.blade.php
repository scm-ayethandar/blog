@extends('layouts.master')

@section('title', 'Home Page')

@section('content')
<div class="container mt-5">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
         <button class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    
@foreach ($posts as $post)
        <div>
            <h3>
                <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
            </h3>
            <!-- @dump($post) -->
            <!-- {{$post->created_at->format('M d, Y')}} by Mark -->
            <!-- {{$post->created_at->toDateTimeString()}} by Mark -->
            {{$post->created_at->diffForHumans()}} by Mark
            <p>{{ $post->body }}</p>
            @auth
            <div class="d-flex justify-content-end">
                <a href="/posts/{{ $post->id }}/edit/" class="btn btn-outline-success">Edit</a>
                <form action="/posts/{{ $post->id }}"
                    method="POST"
                    onsubmit="return confirm('Are you sure to delete?')">
                    @method('DELETE')
                    {{-- <input type="hidden" name="_method" value="DELETE"> --}}
                    @csrf
                    <button type="submit" class="btn btn-outline-danger ms-2">Delete</button>
                </form>
            </div>
            @endauth
            </div>

        <hr>
    @endforeach
    {{ $posts->links() }}

</div>
@endsection 