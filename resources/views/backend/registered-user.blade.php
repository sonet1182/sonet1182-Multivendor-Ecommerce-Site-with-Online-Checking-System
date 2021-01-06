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
                                User Table

                                <div class="text-info">
                                    <span>Total Online User:</span>
                                @php $total ='0' @endphp
                                @foreach ($user as $data)
                                @php
                                    if($data->isUserOnline())
                                    {
                                        $total = $total + 1;
                                    }
                                @endphp
                                @endforeach
                                {{ $total }}
                            </div>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th>Access</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach($user as $data)
                                                <tr>
                                                    <td>{{ $data->id }}</td>
                                                    <td>{{ $data->name }}</td>
                                                    <td>{{ $data->email }}</td>
                                                    <td>
                                                        @if($data->roll_as == NULL)
                                                            User
                                                        @else
                                                        {{ $data->roll_as }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($data->access == NULL)
                                                            <label class="py-2 px-3 badge btn-success">Accepted</label>
                                                        @else
                                                            <label class="py-2 px-3 badge btn-danger">Banned</label>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($data->isUserOnline())
                                                            <label class="py-2 px-3 badge btn-success">Online</label>
                                                        @else
                                                            <label class="py-2 px-3 badge btn-danger">Offline</label>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="roll-edit/{{ $data->id }}" class="badge badge-pill btn-primary px-3 py-2">Edit</a>
                                                        <a href="roll-delete/{{ $data->id }}" class="badge badge-pill btn-danger px-3 py-2">Delete</a>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        </div>
@endsection
