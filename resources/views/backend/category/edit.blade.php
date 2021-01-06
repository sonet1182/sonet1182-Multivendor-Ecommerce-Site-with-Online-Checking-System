@extends('backend.master')

@section('content')

 @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
     </div>
 @endif

<div class="card mb-4">
    <div class="container-fluid">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Edit Product
                            </div>

                            <div class="card-body">
                                <form action="{{ url('update_category/'. $category->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="exampleInputEmail1">Group Name</label>
                                            <select name="group_id" class="form-control">
                                                <option value="{{ $category->id }}">{{ $category->group->name }}</option>
                                                @foreach($data as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="exampleInputEmail1">Name</label>
                                            <input type="text" name="name" class="form-control" id="exampleInputEmail1"  value="{{ $category->description }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Description</label>
                                        <textarea name="description" class="form-control" id="" rows="4" placeholder="">{{ $category->description }}</textarea>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="form-check-label" for="exampleCheck1">Image</label>
                                            <img src="{{ asset('uploads/category/'.$category->photo) }}" alt="" height="250" width="200">
                                            <input type="file" class="form-control" name="file">
                                        </div>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="status" {{ $category->status == '1' ? 'checked' : ' ' }}>
                                        <label class="form-check-label" for="exampleCheck1">Show/Hide</label>
                                    </div>

                                    <div class="pt-3">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                    </form>
                            </div>
                        </div>

                        </div>
@endsection
