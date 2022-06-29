@extends('layouts.master')

@section('title', 'Create Category')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Create Category</h3>
    </div>
    <div class="card-body">

        <form action="/categories/store" method="POST">
            {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
            @csrf

            <div class="mb-3">
                <label class="form-label">Category Name</label>
                <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}">
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-outline-primary">Create</button>
                <a href="/categories" class="btn btn-outline-secondary">Back</a>
            </div>
            </form>
    </div>
    </div>
 @endsection 