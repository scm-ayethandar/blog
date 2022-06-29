@extends('layouts.master')

@section('title', 'Edit Category')

@section('content')

    @if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
         <button class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
<div class="card">
    <div class="card-header">
        <h3>Edit Category</h3>
    </div>
    <div class="card-body">

        <form action="/categories/{{ $category->id }}" method="POST">
            {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Category Name</label>
                <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ $category->name }}">
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-outline-primary">Update</button>
                <a href="/categories" class="btn btn-outline-secondary">Back</a>
            </div>
        </form>
    </div>
</div>
 @endsection 