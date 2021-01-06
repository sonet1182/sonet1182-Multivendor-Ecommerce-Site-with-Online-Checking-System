<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GroupController extends Controller
{
    //Gropu Show view page
    public function group()
    {
        $data = Group::all();
        return view('backend.group.index')->with('data',$data);
    }

    // add-group view page
    public function add_group()
    {
        return view('backend.group.add');
    }

    // adding-group operation
    public function adding_group(Request $req)
    {
        $group = new Group();
        $group->name = $req->input('name');
        $group->description = $req->input('description');

        if($req->input('status') == true)
        {
            $group->status = '1';
        }
        else{
            $group->status = '0';
        }
        $group->save();

        return redirect()->back()->with('status','New Group Added Successfully!');
    }

    // editing group
    public function edit_group($id)
    {
        $data = Group::find($id);

        return view('backend.group.edit')->with('data',$data);
    }

    // updating group
    public function update_group(Request $req,$id)
    {
        $data = Group::find($id);
        $data->name = $req->input('name');
        $data->description = $req->input('description');
        if($req->input('status') == true)
        {
            $data->status = "1";
        }
        else{
            $data->status = '0';
        }
        $data->update();

        return redirect()->back()->with('status','Group data updated Successfully!');
    }

    function delete_group($id){
        Group::destroy($id);
        return redirect()->back()->with('status','Group data Deleted Successfully!');
    }

                            // Category Portion //

    //Category Show view page
    public function category()
    {
        $data = Category::all();
        return view('backend.category.index')->with('category',$data);

    }

     public function add_category()
    {
        $data = Group::all();
        return view('backend.category.add')->with('data',$data);
    }

    public function adding_category(Request $req)
    {
        $category = new Category();
        $category->group_id = $req->input('group_id');
        $category->name = $req->input('name');
        $category->description = $req->input('description');

        if($req->hasfile('file'))
        {
            $destination = 'uploads/category/'.$category->image;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $file = $req->file('file');
            $extension = $file->getClientOriginalExtension();
            $filename = time(). '.' . $extension;
            $file->move('uploads/category/', $filename);

            $category->photo = $filename;
        }

        if($req->input('status') == true)
        {
            $category->status = '1';
        }
        else{
            $category->status = '0';
        }
        $category->save();

        return redirect()->back()->with('status','New category Added Successfully!');
    }

    // editing Category
    public function edit_category($id)
    {
        $data = Category::find($id);
        $item = Group::all();

        return view('backend.category.edit')->with('category',$data)->with('data',$item);
    }

    // updating group
    public function update_category(Request $req,$id)
    {
        $data = Category::find($id);
        $data->group_id = $req->input('group_id');
        $data->name = $req->input('name');
        $data->description = $req->input('description');
        if($req->hasfile('file'))
        {
            $destination = 'uploads/category/'.$data->image;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $file = $req->file('file');
            $extension = $file->getClientOriginalExtension();
            $filename = time(). '.' . $extension;
            $file->move('uploads/category/', $filename);

            $data->photo = $filename;
        }
        if($req->input('status') == true)
        {
            $data->status = "1";
        }
        else{
            $data->status = '0';
        }
        $data->update();

        return redirect()->back()->with('status','Group data has updated Successfully!');
    }

    function delete_category($id){
        Category::destroy($id);
        return redirect()->back()->with('status','Category has Deleted Successfully!');
    }

}