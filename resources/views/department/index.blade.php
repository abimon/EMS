@extends('layouts.admin')

@section('content')
<div class="container">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <div>
        <h2 class='text-center'>{{$univ->uni_name}}</h2>
        <h2 class='text-center'>Departments</h2>
    </div>
    @if(Auth()->user()->department_id==null)
    <div class="d-flex justify-content-end">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDep">+ Add Department</button>

        <!-- Modal -->
        <div class="modal fade" id="addDep" tabindex="-1" aria-labelledby="addDepLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="addDepLabel">Add Department</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{route('department.store')}}" method="post">
                        @csrf
                        <div class="modal-body">
                            <input type="text" name="faculty" id="" placeholder="Faculty/College/School" class="form-control mb-2">
                            <input type="text" name="dep_name" placeholder="Department Name" id="" class="form-control mb-2">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
    <table class="table table-responsive">
        <thead>
            <tr class="text-uppercase">
                <th>#</th>
                <th>Department</th>
                <th>Faculty</th>
                <th>Edit</th>
                <th>Delete</th>
                <th>Created On</th>
            </tr>
        </thead>
        <tbody>
            @foreach($deps as $key=>$dep)
            <tr>
                <td>{{$key+1}}</td>
                <td><a href="{{route('course.index')}}">{{$dep->dep_name}}</a></td>
                <td>{{$dep->faculty}}</td>
                <td class="align-middle">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#Backdrop{{$dep->id}}">
                        Update
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="Backdrop{{$dep->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">{{$dep->dep_name}}</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{route('department.update', $dep->id)}}" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <div class="modal-body">
                                        <input type="text" name="faculty" id="" value="{{$dep->faculty}}" class="form-control mb-2">
                                        <input type="text" name="dep_name" value="{{$dep->dep_name}}" id="" class="form-control mb-2">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-success">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="align-middle">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$dep->id}}">
                        Delete
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop{{$dep->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">{{$dep->dep_name}}</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{route('department.destroy', $dep->id)}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <div class="modal-body">
                                        Are you sure you want to delete this department?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                        <button type="submit" class="btn btn-danger">Sure</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </td>
                <td>{{($dep->updated_at)->diffForHumans()}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection