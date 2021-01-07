<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Category;
use App\Models\sub_Category;
use App\Models\item;
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



                            // Category Portion //

    //Category Show view page
    public function sub_category()
    {
        $data = sub_Category::all();
        return view('backend.sub_category.index')->with('sub_category',$data);

    }

     public function add_sub_category()
    {
        $data = Category::all();
        return view('backend.sub_category.add')->with('data',$data);
    }

    public function adding_sub_category(Request $req)
    {
        $sub_category = new sub_Category();
        $sub_category->category_id = $req->input('category_id');
        $sub_category->name = $req->input('name');
        $sub_category->description = $req->input('description');

        if($req->hasfile('file'))
        {
            $destination = 'uploads/sub_category/'.$sub_category->image;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $file = $req->file('file');
            $extension = $file->getClientOriginalExtension();
            $filename = time(). '.' . $extension;
            $file->move('uploads/sub_category/', $filename);

            $sub_category->photo = $filename;
        }

        if($req->input('status') == true)
        {
            $sub_category->status = '1';
        }
        else{
            $sub_category->status = '0';
        }
        $sub_category->save();

        return redirect()->back()->with('status','New sub_category Added Successfully!');
    }

    // editing sub_Category
    public function edit_sub_category($id)
    {
        $data = sub_Category::find($id);
        $item = Category::all();

        return view('backend.sub_category.edit')->with('sub_category',$data)->with('data',$item);
    }

    // updating group
    public function update_sub_category(Request $req,$id)
    {
        $data = sub_Category::find($id);
        $data->category_id = $req->input('category_id');
        $data->name = $req->input('name');
        $data->description = $req->input('description');
        if($req->hasfile('file'))
        {
            $destination = 'uploads/sub_category/'.$data->image;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $file = $req->file('file');
            $extension = $file->getClientOriginalExtension();
            $filename = time(). '.' . $extension;
            $file->move('uploads/sub_category/', $filename);

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

    function delete_sub_category($id){
        sub_Category::destroy($id);
        return redirect()->back()->with('status','sub_Category has Deleted Successfully!');
    }


    // Item Portion //

    //sub_Category Show view page
    public function item()
    {
        $data = item::all();
        return view('backend.item.index')->with('item',$data);

    }

     public function add_item()
    {
        $data = sub_Category::all();
        return view('backend.item.add')->with('data',$data);
    }

    public function adding_item(Request $req)
    {
        $item = new item();
        $item->sub_category_id = $req->input('sub_category_id');
        $item->name = $req->input('name');
        $item->description = $req->input('description');
        $item->price = $req->input('price');
        $item->offer_price = $req->input('offer_price');
        $item->quantity = $req->input('quantity');

        if($req->hasfile('file'))
        {
            $destination = 'uploads/item/'.$item->image;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $file = $req->file('file');
            $extension = $file->getClientOriginalExtension();
            $filename = time(). '.' . $extension;
            $file->move('uploads/item/', $filename);

            $item->photo = $filename;
        }

        if($req->input('status') == true)
        {
            $item->status = '1';
        }
        else{
            $item->status = '0';
        }
        $item->save();

        return redirect()->back()->with('status','New item Added Successfully!');
    }

    // editing item
    public function edit_item($id)
    {
        $data = item::find($id);
        $item = sub_Category::all();

        return view('backend.item.edit')->with('product',$data)->with('data',$item);
    }

    // updating group
    public function update_item(Request $req,$id)
    {
        $data = item::find($id);
        $data->sub_category_id = $req->input('sub_category_id');
        $data->name = $req->input('name');
        $data->description = $req->input('description');
        $data->price = $req->input('price');
        $data->offer_price = $req->input('offer_price');
        $data->quantity = $req->input('quantity');
        if($req->hasfile('file'))
        {
            $destination = 'uploads/item/'.$data->image;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $file = $req->file('file');
            $extension = $file->getClientOriginalExtension();
            $filename = time(). '.' . $extension;
            $file->move('uploads/item/', $filename);

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

        return redirect()->back()->with('status','Item has updated Successfully!');
    }

    function delete_item($id){
        item::destroy($id);
        return redirect()->back()->with('status','Item has Deleted Successfully!');
    }

    public function show_sub($id)
    {
        $category = Category::find($id);
        $subcat = sub_Category::where('category_id','=',$category->id)->get();

        return view('frontend.home2')->with('subcat',$subcat);
    }

    public function show_items($id)
    {
        $sub_category = sub_Category::find($id);
        $items = item::where('sub_category_id','=',$sub_category->id)->get();

        return view('frontend.home3')->with('items',$items);

    }

    public function product($id)
    {
        $product = item::find($id);

        return view('frontend.product')->with('data',$product);

    }

}
