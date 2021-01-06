<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index(){
        $user = User::all();
        return view('backend.registered-user')->with('user',$user);
    }

    // registered User Edit page
    public function edit($id)
    {
        $user_roll= User::find($id);
        return view('backend.user-edit')->with('user',$user_roll);
    }

    // registered User Edit operation
    public function update(Request $req,$id)
    {
        $user= User::find($id);
        $user->name = $req->input('name');
        $user->roll_as = $req->input('role');
        $user->access = $req->input('access');
        $user->update();

        return redirect()->back()->with('status','Updated Successfully');
    }

    function delete($id){
        User::destroy($id);
        return redirect()->back()->with('status','Deleted Successfully');
    }

}