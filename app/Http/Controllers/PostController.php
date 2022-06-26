<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index()
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
        $posts = Post::paginate(5);

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    { 

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'body' => 'required',
        ]);

        if($validator->fails()) {
            return redirect('/posts/create')
            ->withErrors($validator)
            ->withInput();
        }

        // $post = new Post();
        // $post->title = request('title');
        // $post->body = request('body');
        // $post->created_at = now();
        // $post->updated_at = now();
        // $post->save();

        Post::create([
            'title' => $request->title,
            'body' => $request->body,
            
        ]);

        // $request->session()->flash('success', 'A post was created successfully.');
        session()->flash('success', 'A post was created successfully.');

        return redirect('/posts');
    }

    public function show($id)
    {
        $post = Post::find($id);

        return view('posts.show', compact('post'));
    }

    public function edit($id)
    {
        $post = Post::find($id);

        return view('posts.edit', compact('post'));
    }

    public function update(PostRequest $request, $id)
    {
        
        $post = Post::find($id);
        // $post->title = request('title');
        // $post->body = request('body');
        // $post->updated_at = now();
        // $post->save();

        // $post->update([
        //     'title' => $request->title,
        //     'body' => $request->body,
        // ]);

        $post->update($request->only(['title', 'body']));

        // session()->flash('success', 'A post was updated successfully.');

        // return "Updated post";
        return redirect('/posts')->with('success', 'A post was updated successfully.');
    }

    public function destroy($id)
    {
        Post::destroy($id);

        // return "Deleted Post";
        return redirect('/posts')->with('success', 'A post was deleted.');
    }

}
