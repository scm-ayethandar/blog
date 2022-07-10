<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index(Request $request)
    {


        // Auth::attempt(['email'=>'---', 'password'=>'---']);

        // User::where('id', 5)->first();  //User::find(5);
        // Auth::login($user);

        // Auth::loginUsingId(4);

        // if(Auth::check()) {
        //     return 'Logged In';
        // } else {
        //     return 'Not Logged In';
        // }

        // $user = Auth::user();

        // $posts = Post::all();

        // $posts = Post::select(['posts.*', 'users.name'])
        //          ->join('users', 'users.id', '=', 'posts.user_id')
        //          ->get()->toArray();

        $posts = Post::where('title', 'like', '%' . $request->search . '%')->orderBy('id', 'desc')->paginate(3);

        // $posts = Post::select(['posts.*', 'users.name as author'])
        //          ->join('users', 'users.id', '=', 'posts.user_id')
        //          ->orderBy('id', 'desc')
        //          ->paginate(5);

        // $posts = DB::table('posts')->join('users', 'users.id', '=', 'posts.user_id')->first();

        // $posts = Post::where('title', 'like', '%', $request->search, '%')->orderBy('id', 'desc')->paginate(5);

        // $posts = Post::select(['posts.*', 'categories.name as category'])
        //          ->join('category_post', 'category_post.post_id', '=', 'posts.id')
        //          ->join('categories', 'categories.id', '=', 'category_post.category_id')
        //          ->orderBy('id', 'desc')
        //          ->paginate(5);

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('posts.create', compact('categories'));
    }

    public function store(PostRequest $request)
    { 

        // $validator = Validator::make($request->all(), [
        //     'title' => 'required',
        //     'body' => 'required',
        // ]);

        // if($validator->fails()) {
        //     return redirect(route('posts.create'))
        //     ->withErrors($validator)
        //     ->withInput();
        // }

        // $post = new Post();
        // $post->title = request('title');
        // $post->body = request('body');
        // $post->user_id = Auth::id();
        // $post->created_at = now();
        // $post->updated_at = now();
        // $post->save();

        // $post = Post::create([
        //     'title' => $request->title,
        //     'body' => $request->body,
        //     'user_id' =>Auth::id(),  //auth()->id()
        // ]);


        $file = $request->file('image');
        $filename = time() . '_' . $file->getClientOriginalName();
        $dir = public_path('upload/images');
        $file->move($dir, $filename);

        $post = auth()->user()->posts()->create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' =>Auth::id(),
            'image' => '/upload/images/' . $filename,
        ]);

        $post->categories()->attach($request->category_ids);

        // foreach($request->category_ids as $categoryId) {
        //     DB::table('category_post')->insert([
        //         'post_id' => $post->id,
        //         'category_id' => $categoryId,
        //     ]);
        // }

        // foreach($request->category as $category)
        // {
        //     DB::insert('insert into category_post (post_id, category_id) values (?,?)', [$post->id,$category]);
        // }

        // $request->session()->flash('success', 'A post was created successfully.');
        session()->flash('success', 'A post was created successfully.');

        return redirect(route('posts.index'));
    }

    public function show($id)
    {
        $post = Post::find($id);

        return view('posts.show', compact('post'));
    }

    public function edit($id)
    {
        // $post = Post::find($id);
        // $categories = Category::all();

        $post = Post::find($id);
        $oldCategoryIds = $post->categories->pluck('id')->toArray();
        $categories = Category::all();

        // $post = Post::select(['posts.*', 'users.name as author'])
        //         ->join('users', 'user_id', 'posts.user_id')
        //         ->where('posts.id', $id)
        //         ->first();

                // $post = Post::select(['posts.*', 'users.name as author'])
                // ->join('users', 'user_id', 'posts.user_id')
                // ->find($id);

        // return view('posts.edit', compact('post', 'categories'));

        return view('posts.edit', compact('post', 'categories', 'oldCategoryIds'));
    }

    public function update(PostRequest $request, $id)
    {

        // dd($request);
        
        $post = Post::find($id);
        $post->update($request->only(['title', 'body']));
        $post->categories()->sync($request->category_ids);
        return redirect('/posts')->with('success', 'A post was updated successfully.');

        // DB::table('category_post')
        //     ->where('category_post.post_id', $id)
        //     ->delete();

        // $post->title = request('title');
        // $post->body = request('body');
        // $post->updated_at = now();
        // $post->save();

        // foreach($request->category as $category)
        // {
        //     DB::insert('insert into category_post (post_id, category_id) values (?,?)', [$post->id,$category]);
        // }

        // $post->update([
        //     'title' => $request->title,
        //     'body' => $request->body,
        // ]);

        // $post->update($request->only(['title', 'body']));

        // session()->flash('success', 'A post was updated successfully.');

        // return "Updated post";

        // $post->update($request->only(['title', 'body']));

        // $post->categories()->detach($post->categories->pluck('id')->toArray());
        // $post->categories()->attach($request->category_ids);

        // $post->categories()->sync($request->category_ids);

        // DB::table('category_post')->where('post_id', $post->id)->delete();

        // foreach($request->category_ids as $categoryId) {
        //     DB::table('category_post')->insert([
        //         'post_id' => $post->id,
        //         'category_id' => $categoryId,
        //     ]);
        // }
        // return redirect(route('posts.index'))->with('success', 'A post was updated successfully.');
    }

    public function destroy($id)
    {
        Post::destroy($id);

        // return "Deleted Post";
        return redirect(route('posts.index'))->with('success', 'A post was deleted.');
    }

}
