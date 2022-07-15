<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProfileRequest;
use Symfony\Component\HttpKernel\Profiler\Profile;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit');
    }

    public function update(ProfileRequest $request, $id)
    {
        // dd($request);

        $user = User::findOrFail($id);
        
        if($request->hasFile('image_path'))
        {
            $file = $request->file('image_path');
            $filename = time() . '_' . $file->getClientOriginalName();
            $dir = '/upload/profile';
            $path = $file->storeAs($dir, $filename);
            $user->image_path = $path;
        }

        if($request->password != '')
        {
            $user->password = bcrypt($request->password);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        
        return redirect('/posts')->with('success', 'A post was updated successfully.');
    }
}
