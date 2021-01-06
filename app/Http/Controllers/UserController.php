<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\User;

class UserController extends Controller
{
    //
    function profile()
    {
        return view('frontend.user-profile');
    }

    function updateUserProfile()
    {
        return view('frontend.update-user-profile');
    }

    function edit_profile(Request $req)
    {
        $user_id = Auth::user()->id;
        $user = User::findOrFail($user_id);

        $user->name = $req->input('name');
        $user->email = $req->input('email');
        $user->phone = $req->input('phone');
        $user->address = $req->input('address');

        if($req->hasfile('file'))
        {
            $destination = 'uploads/profile/'.$user->image;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $file = $req->file('file');
            $extension = $file->getClientOriginalExtension();
            $filename = time(). '.' . $extension;
            $file->move('uploads/profile/', $filename);

            $user->photo = $filename;
        }

        $user->update();
        return redirect()->back()->with('status','Your Profile has Updated!');

    }
}