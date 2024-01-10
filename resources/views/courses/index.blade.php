@extends('layouts.admin')

@section('content')
<div class="container">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <div>
        <h2 class='text-center'>Courses</h2>
    </div>
    <div class="d-flex justify-content-end">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addcourse">+ Add Course</button>

        <!-- Modal -->
        <div class="modal fade" id="addcourse" tabindex="-1" aria-labelledby="addcourseLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="addcourseLabel">Add Course</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{route('course.store')}}" method="post">
                        @csrf
                        <div class="modal-body">
                            <input type="text" name="course_name" placeholder="Course Name" id="" class="form-control mb-2">
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
    <table class="table table-responsive">
        <thead>
            <tr class="text-uppercase">
                <th>#</th>
                <th>Course</th>
                <th>Department</th>
                <th>Edit</th>
                <th>Delete</th>
                <th>Created On</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $key=>$course)
            <tr>
                <td>{{$key+1}}</td>
                <td><a href="{{route('course.show',$course->course_name)}}">{{$course->course_name}}</a></td>
                <td>{{Auth()->user()->department}}</td>
                <td class="align-middle">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#Backdrop{{$course->id}}">
                        Update
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="Backdrop{{$course->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">{{$course->course_name}}</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{route('course.update', $course->id)}}" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <div class="modal-body">
                                        <input type="text" name="course_name" value="{{$course->course_name}}" id="" class="form-control mb-2">
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
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$course->id}}">
                        Delete
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop{{$course->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">{{$course->course_name}}</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{route('course.destroy', $course->id)}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <div class="modal-body">
                                        Are you sure you want to delete this course?
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
                <td>{{($course->updated_at)->diffForHumans()}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection