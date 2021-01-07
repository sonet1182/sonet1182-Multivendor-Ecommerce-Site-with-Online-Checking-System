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
                                <form action="{{ url('update_item/'. $product->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="exampleInputEmail1">Sub Category Name</label>
                                            <select name="sub_category_id" class="form-control">
                                                <option value="{{ $product->id }}">{{ $product->sub_category->name }}</option>
                                                @foreach($data as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="exampleInputEmail1">Name</label>
                                            <input type="text" name="name" class="form-control" id="exampleInputEmail1"  value="{{ $product->name }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Description</label>
                                        <textarea name="description" class="form-control" id="" rows="4" placeholder="">{{ $product->description }}</textarea>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="form-check-label" for="exampleCheck1">Price</label>
                                            <input type="number" name="price" class="form-control" id="exampleInputEmail1"  value="{{ $product->price }}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-check-label" for="exampleCheck1">Offer Price</label>
                                            <input type="number" name="offer_price" class="form-control" id="exampleInputEmail1"  value="{{ $product->offer_price }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="form-check-label" for="exampleCheck1">Image</label>
                                            <img src="{{ asset('uploads/item/'.$product->photo) }}" alt="" height="250" width="200">
                                            <input type="file" class="form-control" name="file">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-check-label" for="exampleCheck1">Quantity</label>
                                            <input type="number" name="quantity" class="form-control" id="exampleInputEmail1"  value="{{ $product->quantity }}">
                                        </div>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="status" {{ $product->status == '1' ? 'checked' : ' ' }}>
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
