@extends('layouts.auth')

@section('title', 'Register')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Register</h3>
    </div>
    <div class="card-body">
        {{-- @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
            <li style="color: red;">{{ $error }}</li>
            @endforeach
        </ul>
        @endif --}}

        <form action="/register" method="POST">
            {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
            @csrf

            <div class="mb-3">
                <label class="form-label">Name</label>
                <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}">
                @error('name')
                
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}">
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
                <button type="submit" class="btn btn-outline-primary">Register</button>
                <a href="/posts" class="btn btn-outline-secondary">Back</a>
            </div>
            </form>
    </div>
    </div>
 @endsection 