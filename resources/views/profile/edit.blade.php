@extends('layouts.master')

@section('title', 'Edit Profile')

@section('content')
<div class="container">
    <div class="col-12 mb-3">
        <div class="card">
            <div class="card-header">
                <h3>Edit Profile</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('profile.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Post Image</label>
                        <input class="form-control @error('image_path') is-invalid @enderror" type="file" name="image_path">
                        @error('image_path')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <img class="profile" src="{{ auth()->user()->photo() }}" alt="Profile Image">
                    <!-- @if(Auth::user()->image_path)
                    <img src="{{ Storage::url(Auth::user()->image_path) }}" alt="Post Image">
                    @endif -->
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name', Auth::user()->name) }}">
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">E-mail</label>
                        <input class="form-control @error('email') is-invalid @enderror" type="text" name="email" value="{{ old('email', Auth::user()->email) }}">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" value="{{ old('password') }}">
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-outline-primary">Update</button>
                        <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop