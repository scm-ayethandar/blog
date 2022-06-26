<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if($validator->fails()) {
            return redirect('/login')
            ->withErrors($validator)
            ->withInput();
        }

        $user = User::where('email', $request->email)->first();

        if(! $user) {

            throw ValidationException::withMessages([
                'email' =>"The email is not registered."
            ]);
            return redirect('login');
        }

        $credentials = [
            'email' => $user->email,
            'password' => $request->password,
        ];

        if(! Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' =>"The email or password is incorrect."
            ]);

            return redirect('login');
        } 
        
        return redirect('posts');
        
    }

    public function destroy() 
    {
        Auth::logout();

        return redirect('posts');
    }
}
