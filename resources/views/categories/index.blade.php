@extends('layouts.master')

@section('title', 'Categories')


@section('content')
<div class="container mt-5">

    <div>
        <a class="btn btn primary" href="/categories/create">Create Category</a>
    </div>
    <section class="row">

        <div class="col-12">

            @if (count($categories) > 0)
                @foreach ($categories as $category)
                <div>
                    <h3>
                        {{ $category->name }}
                    </h3>
                    <div class="d-flex justify-content-end">
                        <a href="/categories/edit/{{ $category->id }}" class="btn btn-outline-success">Edit</a>
                        <form action="/categories/delete/{{ $category->id }}"
                            method="POST"
                            onsubmit="return confirm('Are you sure to delete?')">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-outline-danger ms-2">Delete</button>
                        </form>
                    </div>
                </div>
                <hr>
                @endforeach
            @else
                No category.
            @endif
            
        </div>
    </section>
</div>
@endsection