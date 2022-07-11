@extends('layouts.master')

@section('title', 'Edit Post')

@section('content')

@if(session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="card">
    <div class="card-header">
        <h3>Edit Post</h3>
    </div>
    <div class="card-body">
        {{-- @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
            <li style="color: red;">{{ $error }}</li>
        @endforeach
        </ul>
        @endif --}}

        <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Post Image</label>
                <input class="form-control @error('images') is-invalid @enderror @error('images.*') is-invalid @enderror" type="file" name="images[]" multiple>
                @error('images')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                @foreach($errors->get('images.*') as $message)
                <div class="invalid-feedback">{{ $message[0] }}</div>
                @endforeach
            </div>

            <img src="{{ Storage::url($post->images[0]->path) }}" alt="Post Image">
            <div class="mb-3">
                <label class="form-label">Post Title</label>
                <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" value="{{ $post->title }}">
                @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Post Cateory</label>
                <select name="category_ids[]" class="form-select @error('category_ids') is-invalid @enderror" multiple>
                    <option value="">-- select --</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" 
                        @if (in_array($category->id, old('category_ids', $oldCategoryIds)))
                            selected
                        @endif
                        >{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_ids')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Post Body</label>
                <textarea class="form-control  @error('body') is-invalid @enderror" name="body" rows="5">{{ $post->body }}</textarea>
                @error('body')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <!-- @php 
                        $post_categories = App\Models\Category::select(['categories.id', 'categories.name'])
                        ->whereIn('categories.id', Illuminate\Support\Facades\DB::table('category_post')
                        ->select('category_post.category_id')
                        ->where('category_post.post_id', $post->id))
                        ->get();
                    @endphp
            @if($categories->count())
            <select class="form-select" name="category[]" multiple aria-label="Default select example">
                <option>Choose Category</option>
                @foreach($categories as $category)
                    @foreach($post_categories as $post_category)
                        
                        @if($category->id === $post_category->id){ 
                            <option value="{{ $category->id }}" selected>{{ $category->name }}</option> }
                        @else { 
                            <option value="{{ $category->id }}" >{{ $category->name }}</option> }
                        @endif
                    @endforeach               
                @endforeach
            </select>
            @endif -->

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-outline-primary">Update</button>
                <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary">Back</a>
            </div>
        </form>
    </div>
</div>
@endsection