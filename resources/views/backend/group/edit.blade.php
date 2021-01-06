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
                                Edit Group
                            </div>

                            <div class="card-body">
                                <form action="{{ url('update_group/'. $data->id )}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Name</label>
                                        <input type="text" name="name" class="form-control" id="exampleInputEmail1"  value="{{ $data->name }}">

                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Description</label>
                                        <textarea name="description" class="form-control" id="" rows="4" placeholder="">{{ $data->description }}</textarea>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="status" {{ $data->status == '1' ? 'checked' : ' ' }}>
                                        <label class="form-check-label" for="exampleCheck1">Show/Hide</label>
                                    </div>
                                    <div class="pt-3">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                    </form>
                            </div>
                        </div>

                        </div>
@endsection
