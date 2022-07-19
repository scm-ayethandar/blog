<?php

namespace App\Http\Controllers\API;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\API\CategoryStoreRequest;
use App\Http\Requests\API\CategoryUpdateRequest;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest('id')->paginate(5);

        return response()->json(compact('categories'));
    }

    public function store(CategoryStoreRequest $request)
    {
        $category = Category::create($request->only('name'));

        return response()->json(compact('category'), 201);
    }

    public function show($id)
    {
        // select id, name, created_at from categories;
        $category = Category::select(['id', 'name', 'created_at'])->find($id);

        if(! $category) {
            return response()->json([], 404);
        }

        return response()->json([
            'id' => $category->id,
            'name' => $category->name,
            'created_at' => $category->created_at->diffForHumans(),
        ], 200);
    }

    public function update(CategoryUpdateRequest $request, $id)
    {
        $category = Category::find($id);
        if(! $category) {
            // return response()->json([], 404);
            return response()->json([], Response::HTTP_NOT_FOUND);
        }

        $category->update($request->only('name'));
        // return response()->json([], 200);
        return response()->json([], Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if(! $category) {
            return response()->json([], 404);
        }
        // return response()->json([], 200);
        return response()->json([], Response::HTTP_OK);
    }
}
