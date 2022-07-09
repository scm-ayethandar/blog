@extends('layouts.master')

@section('title', 'Edit a Category')

@section('content')
    <div class="container">
        <div class="col-12 mb-3">
            <div class="card">
                <div class="card-header">
                    <h3>Edit a category</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('category.update', ['id' => $category->id]) }}" method="POST">
                        @include('categories._form')
                        @method('PUT')

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-outline-primary">Update</button>
                            <a href="{{ route('category.index') }}" class="btn btn-outline-secondary">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
