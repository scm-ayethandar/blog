<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    { 

        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if($validator->fails()) {
            return redirect('/categories/create')
            ->withErrors($validator)
            ->withInput();
        }

        $category = new Category();
        $category->name = request('name');
        $category->created_at = now();
        $category->updated_at = now();
        $category->save();

        return redirect('/categories');
    }

    public function edit($id)
    {
        $category = Category::find($id);

        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if($validator->fails()) {
            return back()
            ->withErrors($validator)
            ->withInput();
        }
        
        $category = Category::find($id);

       // $category->update($request->only(['name']));

            $category->name = request('name');
            $category->updated_at = now();
            $category->save();

        return redirect('/categories');
    }

    public function destroy($id)
    {
        Category::destroy($id);

        return redirect('/categories');
    }

}
