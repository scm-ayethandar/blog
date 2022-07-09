<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        // $categories = Category::all();


        // if($search = request('search')) {
        //     $categories = Category::where('name', 'like', "%$search%")->latest('id')->paginate(5)->withQueryString();
        // } else {
        //     $categories = Category::latest('id')->paginate(5);
        // }

        // $categories = Category::query();
        // if($search = request('search')) {
        //     $categories->where('name', 'like', "%$search%");
        // }
        // $categories = $categories->latest('id')->paginate(5)->withQueryString();

        $categories = Category::when(request('search'), function($query) {
            $query->where('name', 'like', "%" . request('search') . "%");
        })
        ->latest('id')
        ->paginate(5)
        ->withQueryString();

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
            return redirect(route('category.create'))
            ->withErrors($validator)
            ->withInput();
        }

        // Category::create([
        //     'name' => $request->name
        // ]);


        $category = new Category();
        $category->name = request('name');
        $category->created_at = now();
        $category->updated_at = now();
        $category->save();

        return redirect(route('category.index'))->with('success', 'A category was created successfully.');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, $id)
    {

        // $validator = Validator::make($request->all(), [
        //     'name' => 'required',
        // ]);

        // if($validator->fails()) {
        //     return back()
        //     ->withErrors($validator)
        //     ->withInput();
        // }

        // $category = Category::findOrFail($id);
        // $category->update([
        //     'name' => $request->name
        // ]);
        
        $category = Category::find($id);

       // $category->update($request->only(['name']));

            $category->name = request('name');
            $category->updated_at = now();
            $category->save();

            return redirect(route('category.index'))->with('success', 'A category was updated successfully.');
    }

    public function destroy($id)
    {
        // Category::destroy($id);

        $category = Category::findOrFail($id);
        $category->delete();

        return back()->with('success', 'A category was deleted successfully.');
    }

}
